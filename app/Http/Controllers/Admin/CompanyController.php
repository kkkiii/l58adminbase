<?php
namespace App\Http\Controllers\Admin;

use App\Biz\Area;
use App\Model\Dict\RegEntType;
use App\My\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Company ;
use Illuminate\Support\Facades\DB ;
class CompanyController extends AdminBase
{
    public function user_list()
    {
        parent::check_module();

        $companies = Company::paginate(10);


        return view('admin.company.user_list',compact('companies'));
    }
    public function user_edit($id)
    {
        parent::check_module() ;
        $company = Company::find($id) ;
        $rtypes = RegEntType::get() ;


        $provinces = DB::table('dict_provinces')->pluck("name", "code");

        return view('admin.company.user_edit',compact('company' ,'provinces','rtypes'));
    }
    public function acct_list()
    {
        parent::check_module();
        return view('admin.company.acct_list');
    }
    public function user_edit_post(Request $request)
    {

        parent::check_module() ;


        $company = Company::find($request->post('id'));

        $company->cname = $request->post('cname') ;
        $company->unicode = $request->post('unicode') ;
        $company->rtype = $request->post('rtype') ;



            $company->province_cd = $request->post('province') ;


            $company->province =Area::q_name( $request->post('province') ,'dict_provinces')[0]->name;

            $company->city_cd = $request->post('city') ;
            $company->city =Area::q_name( $request->post('city') ,'dict_cities')[0]->name;


            $company->district_cd = $request->post('district') ;
            $company->district =Area::q_name( $request->post('district') ,'dict_areas')[0]->name;


        $company->reg_addr = $request->post('reg_addr') ;
        $company->legal_person = $request->post('legal_person') ;



      $r =  $company->save() ;

        return redirect(route('company.user_list')) ;


    }

    public function user_del($id)
    {
        parent::check_module() ;
       Company::find($id)->delete();
        return redirect(route('company.user_list')) ;
    }
}
