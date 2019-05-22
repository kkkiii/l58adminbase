<?php
//http://payline.fooddaily.cn/s?t=1&p=8db4dda5-b430-4c5b-8fd4-67181895ea29
Route::get('/s', 'Phone\ScanController@q')->name('scan.q');
//http://payline.fooddaily.cn/phone/s?t=1&p=8dae6640-51cc-4a8a-875c-5b354cefa2ff
//Route::group(['prefix' => 'phone' , 'namespace'=>'Phone'],function () {
//    Route::get('/s', 'ScanController@q')->name('scan.q');
//
//});
