<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends AdminBase
{
    public function user_list()
    {
        parent::check_module();
        return view('admin.company.user_list');
    }
}
