<?php

Route::get('/home', 'Admin\IndexController@home')->name('home');
Route::get('/', 'Admin\LoginController@login');
Route::get('/login', 'Admin\LoginController@login')->name('login');
Route::get('/logout', 'Admin\LoginController@logout')->name('logout');
Route::post('login', 'Admin\LoginController@store')->name('login.store');




$router->get('test/t1','TestController@t1');
$router->get('test/t2','TestController@t2');
$router->get('test/t3','TestController@t3');
$router->get('test/t4','TestController@t4');
$router->get('test/t5','TestController@t5');
$router->get('test/t6','TestController@t6');
$router->get('test/tree','TestController@tree');



Route::get('/page', 'HomeController@index');
Route::get('states/get/{id}', 'HomeController@getStates');


require __DIR__.'./admin.php';
require __DIR__.'./common.php';