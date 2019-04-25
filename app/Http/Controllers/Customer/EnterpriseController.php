<?php

namespace App\Http\Controllers\Customer;

use App\Biz\Area;
use App\Model\Company;
use App\Model\Customer;
use App\My\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Dict\RegEntType ;
use Illuminate\Support\Facades\DB ;

class EnterpriseController extends CustomerBase
{


    public function index(){
        parent::haveto_login() ;
//        $customer = Customer::find(Auth::id());
////        print_r($customer->company->cname );
//        $company = $customer->company ;
        $company = parent::get_bind_company() ;

        if (is_null($company))
            return redirect(route('enterprise.create')) ;
        else
            return redirect(route('enterprise.view')) ;

    }
    public function create(){
        parent::haveto_login() ;
        $rtypes = RegEntType::get() ;

        $provinces = DB::table('dict_provinces')->pluck("name", "code");
        return view(('customer.enterprise_create'),compact('rtypes','provinces')) ;
    }
    public function create_post(Request $request){
        parent::haveto_login() ;
        $data = $this->validate($request,[
            'cname'=>'required|min:5|max:255',
            'unicode'=>'required|unique:companies,unicode|size:18',
            'rtype'=>'digits:3',
            'province'=>'digits:2',
             'city'=>'digits:4',
         'district'=>'digits:6',
'reg_addr'=>'required',
            'legal_person'=>'required',
        ]) ;

        $company =new Company();
        $company->cname = $data['cname'] ;
        $company->unicode = $data['unicode'] ;
        $company->rtype = $data['rtype'] ;
        $company->province_cd = $data['province'] ;
        $company->province = Area::q_name( $data['province'] , 'dict_provinces')[0]->name;
        $company->city_cd = $data['city'] ;
        $company->city =  Area::q_name( $data['city'] , 'dict_cities') [0]->name;
        $company->district_cd = $data['district'] ;
        $company->district =  Area::q_name( $data['district'] , 'dict_areas')[0]->name;
        $company->reg_addr = $data['reg_addr'] ;
        $company->legal_person = $data['legal_person'] ;
        $company->customer_id = Auth::id() ;
        $company->save() ;

        $customer = Customer::find(Auth::id());
        $customer->company_id = $company->id ;
        $customer->save();


        return redirect(route('enterprise.view')) ;

    }

    public function view(){
        parent::haveto_login() ;

        $company = parent::get_bind_company() ;

        return view(('customer.enterprise_view'),compact('company')) ;

    }
    public function edit(){
        parent::haveto_login() ;

        $customer = Customer::find(Auth::id());
        $company = $customer->company ;

        $rtypes = RegEntType::get() ;
        $provinces = DB::table('dict_provinces')->pluck("name", "code");
        return view(('customer.enterprise_edit'),compact('rtypes','provinces' ,'company')) ;
    }

    public function edit_post(Request $request){
        parent::haveto_login() ;
        $data = $this->validate($request,[
            'cname'=>'required|min:5|max:255',
            'unicode'=>'required|unique:companies,unicode|size:18',
            'rtype'=>'digits:3',
            'province'=>'digits:2',
            'city'=>'digits:4',
            'district'=>'digits:6',
            'reg_addr'=>'required',
            'legal_person'=>'required',
        ]) ;

        $company_id = $request->post('id') ;

        $company = Company::find($company_id);
        $company->cname = $data['cname'] ;
        $company->unicode = $data['unicode'] ;
        $company->rtype = $data['rtype'] ;
        $company->province_cd = $data['province'] ;
        $company->province = Area::q_name( $data['province'] , 'dict_provinces')[0]->name;
        $company->city_cd = $data['city'] ;
        $company->city =  Area::q_name( $data['city'] , 'dict_cities') [0]->name;
        $company->district_cd = $data['district'] ;
        $company->district =  Area::q_name( $data['district'] , 'dict_areas')[0]->name;
        $company->reg_addr = $data['reg_addr'] ;
        $company->legal_person = $data['legal_person'] ;
        $company->verify = 0;
        $company->save();

        return view(('customer.enterprise_view'),compact('company')) ;

    }


}
