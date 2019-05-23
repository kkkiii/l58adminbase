<?php
use SimpleSoftwareIO\QrCode\Facades\QrCode ;

Route::group(['prefix' => 'common' , 'namespace'=>'Common'],function () {
    Route::get('/area.get_cities/{id}', 'AreaController@getCities')->name('area.get_cities');
    Route::get('/area.get_district/{id}', 'AreaController@getDistrict')->name('area.get_district');
    Route::post('/mobile.reg', 'MobileVcodeController@get2reg')->name('mobile.reg');
    Route::get('/farm_prod_cate.cate2/{cate1}', 'FarmProdCateController@getCate2')->name('farm_prod_cate.cate2');

    Route::get('qrcode-g/{p}', function ($p) {

      $url = url('preview/'.$p) ;
        return QrCode::size(300)->generate(url($url));
    });
});
