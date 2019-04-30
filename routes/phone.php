<?php


Route::group(['prefix' => 'phone' , 'namespace'=>'Phone'],function () {
    Route::get('/scan/q', 'ScanController@q')->name('scan.q');

});
