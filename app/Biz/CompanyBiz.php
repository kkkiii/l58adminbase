<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/14
 * Time: 17:12
 */

namespace App\Biz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB ;
use App\My\Helpers ;
use App\My\Category ;
use App\Model\Org as OrgModel ;
use App\Model\Customer ;
class CompanyBiz
{

    static public function login_customer_get_company($uid)
    {

        $customer = Customer::find($uid);
        return $customer->company ;

    }

}