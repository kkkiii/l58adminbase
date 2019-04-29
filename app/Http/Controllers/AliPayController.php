<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log ;
use Yansongda\Pay\Pay ;

class AliPayController extends Controller
{
    protected $config = [
        'app_id' => '2016091000478372',
        'notify_url' => 'http://trace.fooddaily.cn/alipay/notify',
        'return_url' => 'http://trace.fooddaily.cn/alipay/return',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2FkMK+IIMhbNrf2A8XkTO4UYFCoOBRNAkRCgmavEug07lPf8WuzyFoXEZJU7dOv65lTljwUVLix9PUR40vKIp9lL3BOZxuHtCDzdnPlugv6GpaWnKUL7HfKWxEcnxUUhlX8tXKdd3B0oiT7dTadj0ifFZw/iAn0XdGI1OGa5n7n7Od4Nu+KIPym+zD/FGH9S/oIz+kbn64iNPYXhs6IVzKb7ISAgY89dT/wSM2L846BsxH0ShVWcdERk2jUCUSwpkPJuOQ+3iZW8Wd1XPHMZMgeysUc9l6AOlPDo0npotEpp/m9e3javZD2mEblZcuLNWTFQOt/IakFuWFf91SwLNwIDAQAB',
        // 加密方式： **RSA2**
        'private_key' => 'MIIEpAIBAAKCAQEA2FkMK+IIMhbNrf2A8XkTO4UYFCoOBRNAkRCgmavEug07lPf8WuzyFoXEZJU7dOv65lTljwUVLix9PUR40vKIp9lL3BOZxuHtCDzdnPlugv6GpaWnKUL7HfKWxEcnxUUhlX8tXKdd3B0oiT7dTadj0ifFZw/iAn0XdGI1OGa5n7n7Od4Nu+KIPym+zD/FGH9S/oIz+kbn64iNPYXhs6IVzKb7ISAgY89dT/wSM2L846BsxH0ShVWcdERk2jUCUSwpkPJuOQ+3iZW8Wd1XPHMZMgeysUc9l6AOlPDo0npotEpp/m9e3javZD2mEblZcuLNWTFQOt/IakFuWFf91SwLNwIDAQABAoIBAB1Dxlq1Q4iK/x12+hcv2oMlmME5gxX6qbQ1vJOs4XqNSa738IHYJVMYmx1D9nv1Y8X+W+MBvAC38eT0uydFuWiDAzjsydNWQjroCM4wC1va1BnaE4eIUPGXG//G5EFR/Z38SwWKei7JHu+ZulPDvcPyr0gmpNrTUvXiRvKvKpLJVMO+LxXBWNMc0TZYKFiRz2bdcVEtytFeVTZeyVByHR8bAyISi7cdJTIHlBzpQ9ae4IHD3cFv60vjpj7k9wcyKTsKlUsOLoUCmWLNJgQUvjBP7bhjKnizNUXOCkSKcgFpzoktOqnVIq7rZX9yQdS5KqGH4e/dcF1SbiGfLQo5GVECgYEA+anm8PQOMUk4Wi4QZ5Vk08i2KH1aNMhWXdBD5179nhJflfvDs6L8P3P7yCvUa80Ct8YeLd0/E6+2Sp8Nx62WWPgUzTqhGyowF9tpVlakS02V9thnNGecHMAJ5zgtxcdKbHiWZ3/owq6rbBjEM65+/tXxezcgkqNmYQ4NjIxq8c8CgYEA3dawIuAhxc7/VN/8hVA3dkR4q4J+rRjwrI/hy6/EkC4/XDhmkSYaO7a6Bp1zHINDBxL6f+TTuBqN3heZTD/sUeBX268BQ3tY3gGvukkJyx5XKlpHa/tSsdanpY2Sl1IxSS7CauCE81IV5XPH+ZXAqraUMu6Rmw61ht0JtWyAMhkCgYEAr9PrVCjdUfKaIFCutvSstMZ3G17kx6WLxbgmCm2IuemArfVIZ1vSwLFjUh8kE+OnFVwO5wgZIzktbbJElyr2ZqQYqkyvJ513j2Wz8t1ECdCTW+weCvcpJ8pLby7OdaqcDHaEnlGj0HAJRDDRBQDQaZKs5bT2WK+BK7sk6aX+r1sCgYBzEG1R2aGK4YBMvNVVLLNn08Ina8ta62nCh+rdZLD2/BX/Nn304aePu4qn7bkMXAVDQRPPjJhIkPVu8hygkTN5kHzhxNdJ8ku483T7kfDTe0xI+oS7PKO6/JT+aP1VIdvQksFjAEvVjYkv96sNCSDjK0qZVGcP30RGzJXBlaK02QKBgQCTNHI6BMe+urpW/Y1VMMgemXBtQ65iXLzIy3YnGue+sHd7zQWHOWHMzmUR8G8eQCM2CQ3AP5+WjcmANRaDVfdzYrcGCurrPurS5/attbXSgSzYbMRZaF5AfarSkHWarQMIZ5ufiNdRJeJt0pfma34mOuBBUi6xJgnN5lmQTDEGgg==',
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
