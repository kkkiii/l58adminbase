<?php

Route::get('/customer/login', 'Customer\LoginController@login')->name('customer.login');
Route::group(['prefix' => 'customer' , 'namespace'=>'Customer'],function () {

    Route::get('/home', 'HomeController@home')->name('customer.home');
    Route::get('/logout', 'LoginController@logout')->name('customer.logout');
    Route::post('login', 'LoginController@store')->name('customer.login.store');
    Route::get('/reg', 'LoginController@reg')->name('customer.login.reg');
    Route::post('/reg', 'LoginController@reg_store')->name('customer.reg.store');
    Route::get('/enterprise.index', 'EnterpriseController@index')->name('enterprise.index');

    Route::get('/enterprise.view', 'EnterpriseController@view')->name('enterprise.view');
    Route::get('/enterprise.create', 'EnterpriseController@create')->name('enterprise.create');
    Route::post('/enterprise.create', 'EnterpriseController@create_post')->name('enterprise.create_post');
    Route::get('/enterprise.edit', 'EnterpriseController@edit')->name('enterprise.edit');
    Route::post('/enterprise.edit', 'EnterpriseController@edit_post')->name('enterprise.edit_post');

    Route::get('/product.list', 'ProductController@list')->name('product.list');
    Route::get('/product.create', 'ProductController@create')->name('product.create');
    Route::post('/product.create', 'ProductController@create_post')->name('product.create_post');
    Route::get('/product.edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::post('/product.edit', 'ProductController@edit_post')->name('product.edit_post');
    Route::get('/product.del/{id}', 'ProductController@del')->name('product.del');
    Route::get('/order.list', 'ProductController@list')->name('order.list');
    Route::get('/code_lable.apply/{pid}', 'CodeLableController@apply')->name('code_lable.apply');

    Route::get('/my.shipping_address', 'ShippingAddressController@list_my')->name('my.shipping_address');
});
