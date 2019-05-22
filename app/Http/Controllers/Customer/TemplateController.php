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
use App\Model\CodeView ;
use App\Model\CompanyUserTemplate ;
class TemplateController extends CustomerBase
{
    public function list(Request $request){


        parent::haveto_login() ;

       $code =  parent::get_bind_company()->company_code  ;

        $products = SyGoods::retrive_list($code)
            ->paginate(15);


        return view('customer.template_list',compact('products')) ;

    }

    public function create(){
        parent::haveto_login() ;
        $company =   parent::get_bind_company() ;

//        $cate1s =FarmProductBiz::cat1_list() ;

//       $level =  DictGoodsLevel::all();

        $provinces =  DictProvince::all();
//       foreach ($level as $item)
//       {
//           dd($item->goods_level) ;
//       }


        return view('customer.template_create',compact('cate1s','company','level','provinces')) ;
    }
    public function create_post(Request $request){
        parent::haveto_login() ;


        $data = $this->validate($request,[
            'title'=>'required',
            'content'=>'required|min:20',
        ]) ;


        $company =   parent::get_bind_company() ;

        $code_view = new CodeView();
        $code_view->title = $data['title'] ;
        $code_view->content = $data["content"] ;
        $code_view->save();


//        DB::table('company_user_template')->where('company_user_id',   $company->id )->delete();


        $middle = new CompanyUserTemplate();
        $middle->company_user_id = $company->id ;
        $middle->template_id = $code_view->id ;
        $middle->save();


//        $product->save();

        return redirect(route('template.list')) ;
    }
    public function edit($id){
        parent::haveto_login() ;
//        $customer = Customer::find(Auth::id());
//        $company = $customer->company ;
        $company =   parent::get_bind_company() ;

        $product =
             SyGoods::retrive_item($id) ;

        $cate1s =FarmProductBiz::cat1_list() ;


        $level =  DictGoodsLevel::all();

        $provinces =  DictProvince::all();


        if ($product)
        return view('customer.template_edit',compact('product' ,'company' , 'cate1s', 'level','provinces')) ;
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
            'sy_goods_name'=>'required',
            'sy_brand_name'=>'required',
            'sy_package_unit'=>'required',
            'sy_uom'=>'required',
            'sy_production_date' => 'nullable|date',
            'sy_goods_number'=>'nullable',
            'sy_shelf_life' => 'required|integer|min:1',
            'sy_uo_shelf_life'=>'required',
            'sy_goods_bases'=>'required',
            'sy_goods_desc'=>'required',
            'sy_lot'=>'required',
            'sy_goods_level'=>'required',
            'sy_origin'=>'required'
        ]) ;


//        $data = $this->validate($request,[
//            'goods_id'=>'required|integer|min:1',
//            'cate1' => 'required|integer|min:1',
//            'cate2' => 'required|integer|min:1',
//            'company_id'=>'required|integer|min:1',
//            'sy_goods_name'=>'required',
//            'sy_brand_name'=>'required',
//            'sy_package_unit'=>'required',
//        ]) ;

        $company =   parent::get_bind_company() ;

        $cate2_title = '';

        if (FarmProductBiz::trans_cate2_name($data['cate2']))
        {
            $cate2_title = FarmProductBiz::trans_cate2_name($data['cate2'])[0]->title ;
        }


        $province_title = Area::q_name( $data['sy_origin'] ,'dict_provinces')[0]->name;
        SyGood::where([
            'sy_usc_id'=> $company->company_code,
            'sy_goods_id'=>$data['goods_id']
        ])
            ->update([
                'sy_pcate' =>$data['cate1'],
                'sy_cate_id' =>$data['cate2'],
                'sy_cgoods' =>$cate2_title,
                'sy_goods_name' =>$data['sy_goods_name'],
                'sy_goods_number'=>$data['sy_goods_number'],
                'sy_brand_name' =>$data['sy_brand_name'],
                'sy_package_unit'=>$data['sy_package_unit'],
                'sy_uom'=>$data['sy_uom'],
                'sy_production_date'=>$data['sy_production_date'],
                'sy_shelf_life'=>$data['sy_shelf_life'],
                'sy_uo_shelf_life'=>$data['sy_uo_shelf_life'],
                'sy_goods_bases'=>$data['sy_goods_bases'],
                'sy_goods_desc'=>$data['sy_goods_desc'],
                'sy_lot'=>$data['sy_lot'],

                'sy_goods_level'=>$data['sy_goods_level'],
                'sy_origin_cd'=>$data['sy_origin'],
                'sy_origin_title'=>$province_title,
            ]);
        return redirect(route('template.list') ) ;
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
           return redirect(route('template.list') ) ;
       }

    }

}
