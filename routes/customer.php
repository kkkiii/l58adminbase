<?php


Route::group(['prefix' => 'customer' , 'namespace'=>'Customer'],function () {
    Route::get('/login', 'LoginController@login')->name('customer.login');
    Route::get('/home', 'HomeController@home')->name('customer.home');
    Route::get('/logout', 'LoginController@logout')->name('customer.logout');
    Route::post('login', 'LoginController@store')->name('customer.login.store');
    Route::get('/enterprise.index', 'EnterpriseController@index')->name('enterprise.index');
    Route::get('/product.list', 'ProductController@list')->name('product.list');
    Route::get('/order.list', 'ProductController@list')->name('order.list');
});
