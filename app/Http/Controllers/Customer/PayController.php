<?php

namespace App\Http\Controllers\Customer;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log ;
use Yansongda\Pay\Pay ;
use App\My\Helpers ;
class PayController extends Controller
{

    protected $ali_config = [
//        'app_id' => '2016092800612186', // dev
        'app_id' => '2019050564362904',
        'notify_url' => 'http://payline.fooddaily.cn/customer/alipay/notify',
        'return_url' => 'http://payline.fooddaily.cn/customer/alipay/return',
    // dev    'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4tVGt09gg2StLVIlz5bPk9BHXTHnUeFy7v4AftVBn/TZ+re78HaYDWznTXpCG/swr6bu+5vVhXcLMaRtHo0SHortEK6Uq+ZijrSFa47DUw3Vm/E7YqOm5ihoeplljXpXXbIAKcqFpfR9Hyaf4PdXK2gaQdSbwpI5Khj5whqdomKvT3saC5aQc+NBWUrjZ2eHvJwR+9jbmf9ceVwSdk0JxWhyGrqeu22X4L+vdHJEQ/uZO34HOxHzMj+YhQjXHeTXrSAQ+yhDCNeKtm7V2exXh2SOKD9m5FNeTZYOWgv7szh5qdcPwz6C4eC9mt+9C7oP3k/BdnAa8BD99NjwckeDPQIDAQAB',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6+RTAZUHOJ/FQnzEjdEA7sqHKkhn0xyNd6DnwI8NZlvakQj166xBMPrcNZnipzWU7tXG+00jPchKvHodVS8XuX3xBx3WUcjlo08ZQzoeVaE6HoM4Pe+NHBpLML2e0+/HTQlx+wEUnvV+zslqfWNi7TyH2u5+Hw7q47UQcb5keg/Xbd1jroIBF3GBGUJ8Fn2pvgNh9RdE9KvU22T26kiB27rOxUm0jh2B2OFTEwEz5/hsyj+4XkhaUaTwaJ1eCcI/sWa7PjCPHzPZu7b5cLfhzWJ2UfRHglTyuqpffZB5skI6gasRSeg/YSSrdwNsLFmbwHrfXSQkamnH9J4E8havswIDAQAB',

        // 加密方式： **RSA2**
        // dev
//        'private_key' => 'MIIEpQIBAAKCAQEA364dWj5xy87Fd+15MZLovW6tvT2q1gqdylqPbqHqdMceX7VUme1T6WjUCKH1M9lzFIICLS9YFF0b9PWLBGcxl0y/Xu8vXKbkcjoUOD61kqlvM8nBLpSsrjyBxB+qanNHfUMMVS9JJR6CoBAvqjs396YtVZKqfDHJM6pt8K/9iIeodqPbRHSqwbnDUSKXc8WeFC4BJnYNzuKwSAT8fk7vs4UjWHH0VTc+7BgKeo5giT6q2VVTpxxvdI33tU0bwRrk5vtLzkWwpO19PWTA7RtTwIC65aQsh+qv/L6sJFHGbQUEyDCYc9YBguA7cCHSqBhb4or+Wli82T91ImfFtf2nKQIDAQABAoIBAQCgbgRVfqYl1KcjLisXmFPf0mtAaOOH41NrGGr5oZ5EpbAuWyNTx7nAllRF4Mu6pYL5uYmQGP3mlSWBGz/bJ5yU9RHpKEpi/LyrBOcNtESM7YN5tIIfQ7lausEkBsY21Xn36MgGrQScX/a2kQVu5kxtDj5Duw8WRqsVqG50C/YfHj2G6QNDPn1sEc1NLN89NAUPfTqHMb1Zp2ZduwWUS2XHJHImn25n1x7Iwh3R4eI/WiZbDIKSMHIApFDzob0PuT0pFoIEt8rASp8hDv3EmvsOs6wSrl7ae+4cd1sJLc09o5I9ANUb2RNaZLi1wx1J1Glx6JJvjcieVTSjh9yzKMd1AoGBAP84qC+abeObab//wJ/eACoqFIWn2oVSBtoTxpaCUtqQJAk5V/XQKewHTAO+4U/ao1Fd34VC87MEbZfQLuxT5U/GiBK6vll9kiOruRWKOzKGnOpDXRtM49xLgHQ4/Vr7C6jEVghQQp/qnGtaKyFsiqmEKpzQO7VNfE7aIdwLwbybAoGBAOBc0ngJt9NlKpALCy9FtzyYJgfJgKzB6a+3AW59VpUI1UpQlpfH1LIqUC0H741RVobyQQoufIfddTDgwzq9yN2Tf3+IbXUYvhk+z52TqKPW3jestGiIz5aI1FixFrNkl/yqL8j3dze6IQ9UiUyQmRa5fec0o5rYEgQ74rmKvy2LAoGBAPkJgut4aBP5WVYVLBOS31xFVWMZ59vBr5fqRhQlNM26ar9pahAdQFrkv+LDxj1SXZyO2gXBz+R1xK6nYLIQJykR00NbX1QZeJk//kkrahoiSkk41EhIXete7Qf7eBTn9HeIpV5VWr2Kg3kpMf7aV++TXLVJZ4nBAzQ6G2IJQtFTAoGAZtECvnGtpRl6XNJCyOII66LJ4s2rwv+GKLkT1d9oWxnWLJ0rtdiklxUe8tPtKnS401SXC6Rr+xM4jjKiJPwt3aSnS/loN74j94u6Nvsg0Bw6b4cckb8IanK/5PkabxFNOUOAbHdDUe1hExZpaQXmsexFTzvnMaGM+BW9e8uieqsCgYEAgQmqZ0XZTTQ8B8OnrVJu+YdH8HplZEDXnDCefv4HHFteIpI5uBT6BGs/wRdr/DLt8aoeeklCf5JvW3WYDsFnNrXBGjPgeHfirRsn+iPSy3frxID+891IcMUjK7RCMXH+VgIvPwSO83NOfZLpVj6HwKuzlH2mNJpWvlpLLosdPJk=',
        //prod
        'private_key' => 'MIIEowIBAAKCAQEA6+RTAZUHOJ/FQnzEjdEA7sqHKkhn0xyNd6DnwI8NZlvakQj166xBMPrcNZnipzWU7tXG+00jPchKvHodVS8XuX3xBx3WUcjlo08ZQzoeVaE6HoM4Pe+NHBpLML2e0+/HTQlx+wEUnvV+zslqfWNi7TyH2u5+Hw7q47UQcb5keg/Xbd1jroIBF3GBGUJ8Fn2pvgNh9RdE9KvU22T26kiB27rOxUm0jh2B2OFTEwEz5/hsyj+4XkhaUaTwaJ1eCcI/sWa7PjCPHzPZu7b5cLfhzWJ2UfRHglTyuqpffZB5skI6gasRSeg/YSSrdwNsLFmbwHrfXSQkamnH9J4E8havswIDAQABAoIBAFv8STIQvyQhiXaH2M3EdqynZVXjrjjwpWnE4RqBriQAJZbw+5TPMwy6hiyQuYWiq1UHH/TW+6sX86zToaSaHJJEvjycMfrqcEHikmNYwoN5v4QufzwHsesHhdKX3tueYQV1bXEH1ta1vKE+gbwriWQheoiw/5V057ur26G/MMc3ro3Ra2YVHuo6hhNPpiDr/eqVvesbRG0Yx+d735vQU3XMELiDyWSlfUUm3OS29KNV0m6cNcfjG3SFnlg0iIyPZaSe7GnKlxfZjO90LJuF0s0MRDf5o/0rzykDmQWrMtFEWvQhXeMeV2ZQdnWiPtPuymqt3/coY832auHbpsXmnYECgYEA9yOpmpqz1/PEjrwnorKd2/8KVU10ETZn9bhH2Lv5P1vynzT2qj4gpcAk/DmT4pER2arFuQ7NT6aEBLQa1GPm+z84HaYKcVXC3JMyGinsk2dbauJsibrxyIfpgCg/9+stGFBunKdnPhrW++XkpBttn6VFGpEfVljjF7Vm1m8RVfECgYEA9FltwL9+xjdBPRLhS72v+R1g5yRR6DWyxbDW7SPFq6id7ZCFBvE8bgqCihoFAUJH2B4B8nKIMNuZ5mXTbd6Dsd+5hiWaG1u58kogLbHA8fiRlxLAjzDPgfscNYI6vqM6rQauB9fLESzms3j94V4oi55Fus84gRKV8jzTe+jIK+MCgYEAr5W00FUNZWaZxddEScGhikX/L2/iAMCox9lvojqa8TsAe8CDZ5zQUTLclB7MRPJQvlcoNzye/fIOZdEYJsH7v5HA6r+nN7J4yYIC3LfgjzGlr6DDAG/DjHeTnCv8lsWNunKaw83j+inTiBBji3y5O+2N1Tw6CX0JizSkpcEvjeECgYANW+JLOmz060puy1xz5p/7T6bfnDW6K01lz4BAoMcK1oIj3dXYBlJWdc6jPD7vza7d2u4iUi6t9SOZ3BFOHW83x1J+Sgn92ur0mybdOK2izQMwrj7G1VVS9uaY6lDJ4WSw1v+mwB6DBuBqCYBf1OUElRec2f1t2RVHlBm/2X8wHwKBgGZNJSyQ66S5LNXov/HMgGoBxfedi/tyVTIM4CxEbMf/c0uP1HjW+QGfji1RbrbZ3aTbyauDOXQysCSdn0FCpTW4KTjf6id9jmH5W2R9FFgRlVqfibeDWyRxPb2+BuTG4QnzlKJ997QEjLBZXQ18m2eRIcY+SwMcCMuwDXo7nRoQ',

        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
//        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
        'mode' => 'normal', // optional,设置此参数，将进入沙箱模式
    ];


    public function choose(Request $request,$ordid)
    {
//        dump($ordid) ;

     $ord =   Order::where(['our_sn'=>$ordid])->first() ;

        return view('customer.pay.choose' ,[
            'ord' =>$ord
        ]) ;
    }
    public function choose_post(Request $request)
    {

        $int_amount = intval( $request->post('tot_amount') );
        $order = [
            'out_trade_no' => $request->post('ordsn') ,
            'total_amount' => $int_amount/100 ,
            'subject' => '买标码的订单sn:' .  $request->post('ordsn') ,
        ];

        $alipay = Pay::alipay($this->ali_config)->web($order);

        return $alipay->send();// laravel 框架中请直接 `return $alipay`


    }



/*    public function send()
    {

        $order = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ];

        $alipay = Pay::alipay($this->ali_config)->web($order);

        return $alipay->send();// laravel 框架中请直接 `return $alipay`
    }*/

    public function return()
    {
        $data = Pay::alipay($this->ali_config)->verify(); // 是的，验签就这么简单！

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount

        $ord =   Order::where(['our_sn'=>$data->out_trade_no])->first() ;
        $ord->flow_stop = 1 ;
        $ord->save();

        session()->flash(
            'success','恭喜支付成功了'
        ) ;
        return redirect(route('order.list') ) ;



    }

    public function notify()
    {

        $alipay = Pay::alipay($this->ali_config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况




        } catch (\Exception $e) {
            // $e->getMessage();
        }

//        return $alipay->success()->send();// laravel 框架中请直接 `return $alipay->success()`
        return $alipay->success();

    }



}
