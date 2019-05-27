<?php
namespace App\Http\Controllers\Customer;
use App\Biz\FarmProductBiz;
use App\Biz\SyGoods;
use App\Biz\TemplateBiz;
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
use Illuminate\Support\Facades\Validator ;
use Illuminate\Support\Facades\Input ;
class TemplateController extends CustomerBase
{
    public function list(Request $request){
        parent::haveto_login() ;
        $company = parent::get_bind_company() ;


     $res = TemplateBiz::qlist($company->id) ;
        $recs = $this->arrayPaginator($res, $request);


        return view('customer.template_list',compact('recs')) ;

    }

    public function create(){
        parent::haveto_login() ;
        $company =   parent::get_bind_company() ;


        $provinces =  DictProvince::all();


        return view('customer.template_create',compact('cate1s','company','level','provinces')) ;
    }
    public function create_post(Request $request){
        parent::haveto_login() ;


        $data = $this->validate($request,[
            'title'=>'required',
            'content'=>'nullable|min:20',
        ]) ;

        $content = $request->post('content') ;


        if(is_null($content))
        {
            session()->flash(
                'danger','缺少内容信息'
            ) ;
            return redirect(route('template.create'));
        }



        $code_view = new CodeView();
        $code_view->title =$data['title'];
        $code_view->content =$content;
        $code_view->save();

        $company = parent::get_bind_company() ;
        $middle = new CompanyUserTemplate();
        $middle->company_user_id = $company->id ;
        $middle->template_id = $code_view->id ;
        $middle->save();



        return redirect(route('template.list')) ;
    }
    public function edit($id){
        parent::haveto_login() ;

        $item = TemplateBiz::qitem($id) ;

        dd($item->is_edit) ;

        return view('customer.template_edit',compact( 'item')) ;

    }
    public function edit_post(Request $request){
        parent::haveto_login() ;

        $data = $this->validate($request,[
            'id'=>'required|integer',
            'title'=>'required',
            'content'=>'nullable|min:20',
        ]) ;

        $content = $request->post('content') ;


        if(is_null($content))
        {
            session()->flash(
                'danger','缺少内容信息'
            ) ;
            return redirect(route('template.create'));
        }


        $code_view = CodeView::find($data['id']) ;
        $code_view->title = $data['title'] ;
        $code_view->content = $content ;
        $code_view->save();

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
           return redirect(route('template.list') ) ;
       }else
       {
           session()->flash(
               'success','不要删除别人的产品'
           ) ;
           return redirect(route('template.list') ) ;
       }

    }

}
