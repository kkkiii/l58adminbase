<?php


Route::group(['prefix' => 'phone' , 'namespace'=>'Phone'],function () {
    Route::get('/s', 'ScanController@q')->name('scan.q');

});
