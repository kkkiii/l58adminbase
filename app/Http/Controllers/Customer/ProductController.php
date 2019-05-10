<?php
namespace App\Http\Controllers\Customer;
use App\Biz\FarmProductBiz;
use App\Biz\SyGoods;
use App\Model\Dict\DictProvince;
use App\Model\Dict\FarmProduct;
use App\Model\Product;
use App\My\Helpers;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Product as ProductModel ;
use App\Model\Customer ;
use App\Biz\ShippingAddress ;
use Illuminate\Support\Facades\DB ;
use App\Model\SyGood ;
use App\Model\Dict\DictGoodsLevel ;
use App\Biz\Area ;
class ProductController extends CustomerBase
{
    public function list(Request $request){


        parent::haveto_login() ;

       $code =  parent::get_bind_company()->company_code  ;




        $products = SyGoods::retrive_list($code)
            ->paginate(15);



        return view('customer.product_list',compact('products')) ;



    }

    public function create(){
        parent::haveto_login() ;

        $company =   parent::get_bind_company() ;

        $cate1s =FarmProductBiz::cat1_list() ;

       $level =  DictGoodsLevel::all();

        $provinces =  DictProvince::all();
//       foreach ($level as $item)
//       {
//           dd($item->goods_level) ;
//       }


        return view('customer.product_create',compact('cate1s','company','level','provinces')) ;
    }
    public function create_post(Request $request){
        parent::haveto_login() ;

        $data = $this->validate($request,[
            'cate1' => 'required|integer|min:1',
            'cate2' => 'required|integer|min:1',
            'sy_goods_name'=>'required',
            'sy_brand_name'=>'required',
            'sy_package_unit'=>'required',
            'sy_uom'=>'required',
            'sy_production_date' => 'nullable|date',
            'sy_shelf_life' => 'required|integer|min:1',
             'sy_uo_shelf_life'=>'required',
            'sy_goods_bases'=>'required',
            'sy_goods_desc'=>'required',
            'sy_lot'=>'required',
            'sy_goods_level'=>'required',
            'sy_origin'=>'required'
        ]) ;

        $sy_goods_number = $request->post('sy_goods_number') ;


        $company = parent::get_bind_company() ;

        $product = new SyGood() ;
        $product->sy_usc_id = $company->company_code;


        $product->sy_cate_id = $data['cate2'] ;


        $cate2_title = '';

        if (FarmProductBiz::trans_cate2_name($data['cate2']))
        {
            $cate2_title = FarmProductBiz::trans_cate2_name($data['cate2'])[0]->title ;
        }


        $product->sy_cgoods = $cate2_title ;

        $product->sy_pcate = $data['cate1'] ;

        $product->sy_goods_name = $data['sy_goods_name'] ;$product->sy_brand_name = $data['sy_brand_name'] ;

        $product->sy_package_unit =  $data['sy_package_unit'] ;

        if ($sy_goods_number)
                $product->sy_goods_number = $sy_goods_number ;

        $product->sy_goods_number = $data['sy_production_date']  ;
        $product->sy_uom = $data['sy_uom']  ;

        $product->sy_shelf_life = $data['sy_shelf_life']  ;
        $product->sy_uo_shelf_life = $data['sy_uo_shelf_life']  ;

        $product->sy_goods_bases = $data['sy_goods_bases']  ;
        $product->sy_goods_desc = $data['sy_goods_desc']  ;


        $product->sy_lot = $data['sy_lot']  ;
        $product->sy_goods_level = $data['sy_goods_level']  ;
        $product->sy_origin_cd = $data['sy_origin']  ;

        $product->sy_origin_title = Area::q_name( $data['sy_origin']  ,'dict_provinces')[0]->name;
        $product->save();

        return redirect(route('product.list')) ;
    }
    public function edit($id){
        parent::haveto_login() ;
//        $customer = Customer::find(Auth::id());
//        $company = $customer->company ;
        $company =   parent::get_bind_company() ;

        $product =
             SyGoods::retrive_item($id) ;



        $cate1s =FarmProductBiz::cat1_list() ;


        if ($product)
        return view('customer.product_edit',compact('product' ,'company' , 'cate1s')) ;
        else
        {
            session()->flash(
                'success','读取失败'
            ) ;
            return redirect(route('product.list') ) ;
        }

    }
    public function edit_post(Request $request){
        parent::haveto_login() ;


        $data = $this->validate($request,[
            'goods_id'=>'required|integer|min:1',
            'cate1' => 'required|integer|min:1',
            'cate2' => 'required|integer|min:1',
            'company_id'=>'required|integer|min:1',
            'sy_goods_name'=>'required',
            'sy_brand_name'=>'required',
            'sy_package_unit'=>'required',
        ]) ;


        $company =   parent::get_bind_company() ;

        $cate2_title = '';

        if (FarmProductBiz::trans_cate2_name($data['cate2']))
        {
            $cate2_title = FarmProductBiz::trans_cate2_name($data['cate2'])[0]->title ;
        }


        SyGood::where([
            'sy_usc_id'=> $company->company_code,
            'sy_goods_id'=>$data['goods_id']
        ])
            ->update([
                'sy_pcate' =>$data['cate1'],
                'sy_cate_id' =>$data['cate2'],
                'sy_cgoods' =>$cate2_title,
                'sy_goods_name' =>$data['sy_goods_name'],
                'sy_brand_name' =>$data['sy_brand_name']
            ]);
        return redirect(route('product.list') ) ;
    }

    public function del(Request $request,$id){
        parent::haveto_login() ;

        $company =  parent::get_bind_company() ;

       $product = SyGood::find($id) ;

       if ($product->sy_usc_id == $company->company_code)
       {
           $product->delete();
           session()->flash(
               'success','删除成功'
           ) ;
           return redirect(route('product.list') ) ;
       }else
       {
           session()->flash(
               'success','不要删除别人的产品'
           ) ;
           return redirect(route('product.list') ) ;
       }

    }

}
