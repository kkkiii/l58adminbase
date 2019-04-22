<?php

namespace App\Http\Controllers\Customer;

use App\Model\Product;
use App\My\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Product as ProductModel ;
use App\Model\Customer ;
class ProductController extends CustomerBase
{
    public function list(){
        parent::haveto_login() ;
        $customer = Customer::find(Auth::id());
        $company = $customer->company ;
        $products = ProductModel::where(
            [
                'company_id'=>$company->id
            ]
        )->paginate(10);

        return view('customer.product_list',compact('products')) ;
    }

    public function create(){
        parent::haveto_login() ;
        $product =new ProductModel();

        $customer = Customer::find(Auth::id());
        $company = $customer->company ;

        return view('customer.product_create',compact('products','company')) ;
    }
    public function create_post(Request $req){
        parent::haveto_login() ;
        $data = $this->validate($req,[
            'pname'=>'required',
            'company_id'=>'required|numeric',
        ]) ;
        $product =new Product();
        $product->pname = $data['pname'] ;
        $product->company_id = $data['company_id'] ;
        $product->save() ;
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
        ]) ;
        $customer = Customer::find(Auth::id());
        $company = $customer->company ;
        Product::where('company_id', $company->id)
            ->update(['pname' =>$data['pname']]);
        return redirect(route('product.list') ) ;
    }

    public function del(Request $request,$id){
        parent::haveto_login() ;



        $customer = Customer::find(Auth::id());
        $company = $customer->company ;

       $product = Product::find($id) ;


       if ($product->company_id == $company->id)
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
