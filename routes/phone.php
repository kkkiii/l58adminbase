<?php
Route::get('/s', 'Phone\ScanController@q')->name('scan.q');
//http://payline.fooddaily.cn/phone/s?t=1&p=8dae6640-51cc-4a8a-875c-5b354cefa2ff
//Route::group(['prefix' => 'phone' , 'namespace'=>'Phone'],function () {
//    Route::get('/s', 'ScanController@q')->name('scan.q');
//
//});
