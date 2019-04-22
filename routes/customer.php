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

    Route::get('/my_address.list', 'ShippingAddressController@list_my')->name('my_address.list');
    Route::get('/my_address.add', 'ShippingAddressController@add')->name('my_address.add');
    Route::get('/my_address.del/{id}', 'ShippingAddressController@del')->name('my_address.del');
    Route::get('/my_address.edit/{id}', 'ShippingAddressController@edit')->name('my_address.edit');
    Route::post('/my_address.edit', 'ShippingAddressController@edit_post')->name('my_address.edit_post');
    Route::get('/my_address.default/{id}', 'ShippingAddressController@set_default')->name('my_address.default');
});
