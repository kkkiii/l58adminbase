<?php
namespace App\Http\Controllers\Customer;
use App\Biz\Area;
use App\Biz\Org;
use App\Car;
use App\Http\Controllers\Common\AreaController;
use App\Jobs\SleepSeconds;
use App\Model\Customer;
use App\Model\Dict\DictOrdFlowstop;
use App\Model\Module;
use App\Model\WST\YqCompanyUser;
use App\My\Helpers;
use App\My\MyAuth;
use App\Vo\CodeGenVo;
use App\Vo\Vo1;
use Faker\Provider\HtmlLorem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
//use Illuminate\Support\Facades\Redis;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Redis ;
use App\Biz\PCACodeBiz ;
use App\My\Category ;
use App\My\Menu ;
use IntlChar ;
use App\My\MyStr ;
use Illuminate\Support\Str ;
use Illuminate\Support\Arr;
use App\Model\CodeTagType ;
use App\Biz\ShippingAddress ;
use Illuminate\Support\Facades\Queue ;
use Illuminate\Support\Facades\Mail ;
use Illuminate\Support\Facades\Log ;
use App\Jobs\CodeGen ;
use Pay;
use App\Http\Controllers\Controller ;
class TestController extends CustomerBase
{
    public function t1(Request $request)
    {
$company = parent::get_bind_company() ;
dump($company->id) ;
        $code =  parent::get_bind_company()->company_code ;
dump($code ) ;
dd($company) ;
    }
    public function t2(){
        $url = url('preview?p=' . 5);
//        print_r($url) ;

        print_r(  url('common/qrcode-g') .   ('/preview?p=' . 1) ) ;

    }
}

