<?php


Route::group(['prefix' => 'phone' , 'namespace'=>'Phone'],function () {
    Route::get('/s/q', 'ScanController@q')->name('scan.q');

});
