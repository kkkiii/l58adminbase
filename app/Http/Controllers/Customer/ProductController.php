<?php

namespace App\Http\Controllers\Customer;

use App\Biz\FarmProductBiz;
use App\Model\Product;
use App\My\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Product as ProductModel ;
use App\Model\Customer ;
use App\Biz\ShippingAddress ;
use Illuminate\Support\Facades\DB ;
class ProductController extends CustomerBase
{
    public function list(){
        parent::haveto_login() ;
//        $customer = Customer::find(Auth::id());
//        $company = $customer->company ;

       $cid =  parent::get_bind_company()->id  ;

        $products = ProductModel::where(
            [
                'wst_company_id'=>$cid
            ]
        )->paginate(10);
//
        return view('customer.product_list',compact('products')) ;



    }

    public function create(){
        parent::haveto_login() ;

        $company = parent::get_bind_company() ;

        $cate1s =FarmProductBiz::cat1_list() ;

//        dump($cate1s) ;
//        dd($cate1s[0]->big_category) ;




        return view('customer.product_create',compact('cate1s','company')) ;
    }
    public function create_post(Request $req){
        parent::haveto_login() ;



        $data = $this->validate($req,[
            'variety'=>'required',
            'cate2' => 'required|integer|min:1',
            'company_id'=>'required|integer|min:1',
        ]) ;
//        dd($req->post()) ;
        $company = parent::get_bind_company() ;

        $product = new Product() ;
        $product->wst_company_id = $data['company_id'] ;
        $product->cate2 = $data['cate2'] ;
        $product->variety = $data['variety'] ;
        $product->save();

//        $wst_company_id = $data['company_id'] ;
//        $cate2 = $data['cate2'] ;
//        $variety = $data['variety'] ;
//
//        DB::table('products')->insert(
//            ['wst_company_id' =>$wst_company_id,
//                'cate2' => $cate2,
//                'variety' => $variety
//            ]
//        );


//        if ($company->verify ==1)
//        ;
//        else
//        {
//            session()->flash(
//                'success','公司资料等待审核'
//            ) ;
//            return redirect(route('product.list') ) ;
//        }

//        $product =new Product();
//        $product->pname = $data['pname'] ;
//        $product->company_id = $data['company_id'] ;
//        $product->save() ;
        return redirect(route('product.list')) ;
    }
    public function edit($id){
        parent::haveto_login() ;
        $customer = Customer::find(Auth::id());
        $company = $customer->company ;
        $product =
        Product::where([
            'id'=>$id ,
            'company_id'=>$company->id
        ])
                ->first();

        if ($product)
        return view('customer.product_edit',compact('product' ,'company')) ;
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
            'pname'=>'required',
            'company_id'=>'required|numeric',
            'product_id'=>'required|numeric'
        ]) ;
        $customer = Customer::find(Auth::id());
        $company = $customer->company ;
        Product::where([
            'company_id'=> $company->id,
            'id'=>$data['product_id']
        ])
            ->update(['pname' =>$data['pname']]);
        return redirect(route('product.list') ) ;
    }

    public function del(Request $request,$id){
        parent::haveto_login() ;

        $company =  parent::get_bind_company() ;

       $product = Product::find($id) ;


       if ($product->wst_company_id == $company->id)
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
