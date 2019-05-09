<?php
namespace App\Http\Controllers\Customer;
use App\Biz\FarmProductBiz;
use App\Biz\SyGoods;
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




        return view('customer.product_create',compact('cate1s','company')) ;
    }
    public function create_post(Request $request){
        parent::haveto_login() ;

        $data = $this->validate($request,[
            'cate1' => 'required|integer|min:1',
            'cate2' => 'required|integer|min:1',
            'sy_goods_name'=>'required',
            'sy_brand_name'=>'required',
        ]) ;


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
