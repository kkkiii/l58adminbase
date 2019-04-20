<?php

Route::get('/customer/login', 'Customer\LoginController@login')->name('customer.login');
Route::group(['prefix' => 'customer' , 'namespace'=>'Customer'],function () {

    Route::get('/home', 'HomeController@home')->name('customer.home');
    Route::get('/logout', 'LoginController@logout')->name('customer.logout');
    Route::post('login', 'LoginController@store')->name('customer.login.store');
    Route::get('/enterprise.index', 'EnterpriseController@index')->name('enterprise.index');

    Route::get('/enterprise.view', 'EnterpriseController@view')->name('enterprise.view');
    Route::get('/enterprise.create', 'EnterpriseController@create')->name('enterprise.create');
    Route::post('/enterprise.create', 'EnterpriseController@create_post')->name('enterprise.create_post');
    Route::get('/enterprise.edit', 'EnterpriseController@edit')->name('enterprise.edit');
    Route::post('/enterprise.edit', 'EnterpriseController@edit_post')->name('enterprise.edit_post');

    Route::get('/product.list', 'ProductController@list')->name('product.list');
    Route::get('/order.list', 'ProductController@list')->name('order.list');
});
