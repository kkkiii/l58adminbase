<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log ;
use Yansongda\Pay\Pay ;
use App\My\Helpers ;
class AliPayController extends Controller
{
    protected $config = [
        'app_id' => '2016091000478372',
        'notify_url' => 'http://103.254.66.20:32990/alipay/notify',
        'return_url' => 'http://103.254.66.20:32990/alipay/return',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiGG4yBu54g/TxkBjuYj6TQvbhbkcXIPyf9fzGj6YvLApehpbNmH2O5hiMCfNl917FAnNNaIp8+BC8rl4Z5UTPgV979x8OfOHWmaZYD0wqCuqkAl6mwuoevFKNpmdwk31zrRh4rl81JKNIndwZw6/+qG5KAQS52Y2YChnMUVCc/XUOTaZeTHiOHuoM77JXkJDNMMsyl1tM/nVZ6w1OYOGM+ZjREb1adzCuEGM3YoiU/e0hL6/QNDpq3Nej7RKZg7lvSjSVfbDc/wdvYrp9zpJofDtk6frESaor7we9EZhQOLEEHWdXxNrgqitmFv6mUOd2l7dpkillNdYCGZPjiRSXQIDAQAB',
        // 加密方式： **RSA2**
        'private_key' => 'MIIEpQIBAAKCAQEAsKrajnORlNI7te0IsxOx+MxMjPbpBxvaAV8khcFb9Nb2RjzwqrSj/mmFIVMZMgVejXJxQTWAQEeSv56EURirGGTRDGwJkgQFM+DguDr33NTtjTe2Jq+ghApPrrvIRa3WD5n52aUnBAVyxciMbj+WtloZGQd1sAkDLf+zDKeNiWWnNWz42xmJOPmENuANE5ibo8/6NQVseMxRxO5WnE9BHXNaf441B+J4SoUJIC4/FMFuYbeifH0J2DYI7ozeChdmAYl3QOk1W+mMtkWwZI6YWzOcsyVl85X10sA/QQkEDcAWNSkoNoI3r7gyOGcvbEN/sjBlsCIe8pY6X//P5SI5bQIDAQABAoIBAB+g5vH75MNlBAWlAxq0Wvd08/uEtOFt7hCyzOIZZPInjf2zKU8WegmxMIFv1CHtbikapQYMowJfDfm6UmwGY5NBcV+s8+WtTJUmHHU/MWLayBCxOa4hYTZidjONMOSwo5M1eNKrS5nfs9WO+v096yiIZtfhSwOSCXyxu4d3c9J2ERHgNFEopKAdwYn1s4tIPsBdqMRN7NdufztWiFEybhlWdMHnTLN7rYDw5WSqr0TxfZnkxRMDUu9LO/yZ9ikoQR+ipqays2D9HBCaSKJvnBlb7U+usK0Qii+E8kjtBf4KXdk8y05krsaz/Fpcxstv5aoIE/0DLkGVsWZW615Wx40CgYEA6B8Vlku/1iPEeUbfLPdnLvmkJ9GOHWUnbx3y2STos+jYBJ/WJv9wwhPlEuZCa++Ca2ENTMru83+0IYZC11K1ncPpVlNmTsbzuiM4xx0JMmf09u5QgG3bTA/NlmYypslw6zVSo2HUV06EAYjQoVqBVfnKXTiV17DHKSj2f0sjMrMCgYEAwtdjW/wNcpHksQzdTL8NnnxMkacnmgQ7jTEOkTfkPkUnty2LnljnVlP79uPufPKQ+Rw8ek9tXDfGii3hoOKpUeXgDSyU8XRUmi3Y49pE3k2pSICEVW+1kup7DZ3pnDwINzRoQbCzQxRc/Xg1i444OOhiPHWPCyErRhphnzWEc18CgYEAr9v9CuVQ7fgjPo7HPtYhwqE4EULenL6qZbEW8BTaiJN8NeSy5tDYqPFRuEPjRssq0Bezb96/spOp8Uw7D8+F8YUgH1sIQ97PgNJ2jcQd16aTHRHow6R3ZOUEKVI8RciQWGMJvOa9bXf64v64scZT/sNE4eOhAszX1wNF3aMbg6kCgYEAkcr3pynIqjUu6aiVo0rGlxOte8OXJ3EJWpIds14eJNY8bJ3g/kDKAdfgDxLpLoeXIUAWpPLwAvQdVOIWFfvk9MpMx67XWIFSmPe7dmup4qo8BGteGkv3kxJvt3W1C1oET8KgTJ860/PVzTh44I8v1K1WbKUOvyY3qkItUCOMk4MCgYEA5/MzcvwSkNYbYPSPlGU7DXayrfyICKmAQ49lgmGR/k7wIMZL/4h4d/BoWNobx9AXMJaIT+9nRVBZTYq+pxahYEjPUh1WoX6Jjk4vaMIm2fR/jNJJcDYSK2lMyNWF8xzolj6jQd94xI+rrxYq/ztmRc+oB5ej4dptG2WLRhwDq6M=',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];

    public function send()
    {
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ];

        $alipay = Pay::alipay($this->config)->web($order);

        return $alipay->send();// laravel 框架中请直接 `return $alipay`
    }

    public function return()
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
    }

    public function notify()
    {
        $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success()->send();// laravel 框架中请直接 `return $alipay->success()`
    }
}
