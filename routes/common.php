<?php


Route::group(['prefix' => 'common' , 'namespace'=>'Common'],function () {
    Route::get('/area.get_cities/{id}', 'AreaController@getCities')->name('area.get_cities');
    Route::get('/area.get_district/{id}', 'AreaController@getDistrict')->name('area.get_district');
});
