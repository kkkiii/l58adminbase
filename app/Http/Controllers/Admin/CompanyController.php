<?php
namespace App\Http\Controllers\Admin;

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
}
