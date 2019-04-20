<?php


Route::group(['prefix' => 'admin' , 'namespace'=>'Admin'],function () {
    Route::get('/priviledge.list', 'PriviledgeController@list')->name('priviledge.list');
    Route::get('/priviledge.roles', 'PriviledgeController@roles')->name('priviledge.roles');
    Route::get('/priviledge.mgrs', 'PriviledgeController@mgrs')->name('priviledge.mgrs');

    Route::get('/priviledge.edit_role/{id}', 'PriviledgeController@edit_role')->name('priviledge.edit_role');
    Route::post('/priviledge.edit_role_post', 'PriviledgeController@edit_role_post')->name('priviledge.edit_role_post');
    Route::get('/priviledge.del/{id}', 'PriviledgeController@del')->name('priviledge.del');
    Route::get('/priviledge.add_role', 'PriviledgeController@add_role')->name('priviledge.add_role');
    Route::get('/priviledge.add_admin', 'PriviledgeController@add_admin')->name('priviledge.add_admin');
    Route::post('/priviledge.add_role',   'PriviledgeController@add_admin_post')->name('priviledge.add_admin_post');
    Route::get('/priviledge.roles2mgrs', 'PriviledgeController@roles2mgrs')->name('priviledge.roles2mgrs');
    Route::get('/priviledge.roles2mgrs_fill/{id}', 'PriviledgeController@roles2mgrs_fill')->name('priviledge.roles2mgrs_fill');
    Route::post('/priviledge.roles2mgrs_fill', 'PriviledgeController@roles2mgrs_fill_post')->name('priviledge.roles2mgrs_fill_post');
    Route::post('/priviledge.add_role_post', 'PriviledgeController@add_role_post')->name('priviledge.add_role_post');
    Route::get('/priviledge.modules2role/{id}', 'PriviledgeController@modules2role')->name('priviledge.modules2role');
    Route::post('/priviledge.modules2role', 'PriviledgeController@modules2role_post')->name('priviledge.modules2role_post');

    Route::get('/company.user_list', 'CompanyController@user_list')->name('company.user_list');
    Route::get('/company.acct_list', 'CompanyController@acct_list');
    Route::get('/company.user_edit/{id}', 'CompanyController@user_edit');
    Route::post('/company.user_edit', 'CompanyController@user_edit_post')->name('company.user_edit_post');
    Route::get('/company.user_del/{id}', 'CompanyController@user_del');
    Route::get('/company.user_verify/{id}', 'CompanyController@user_verify')->name('company.user_verify');
    Route::post('/company.user_verify', 'CompanyController@user_verify_post')->name('company.user_verify_post');

    Route::get('/govmgr.org_list', 'GovMgrController@org_list');
    Route::get('/govmgr.org_list_del/{id}', 'GovMgrController@org_list_del')->name('govmgr.org_list_del');
    Route::get('/govmgr.org_list_edit/{id}', 'GovMgrController@org_list_edit')->name('govmgr.org_list_edit');
    Route::post('/govmgr.org_list_edit', 'GovMgrController@org_list_edit_post')->name('govmgr.org_list_edit_post');
    Route::get('/govmgr.org_list_sub/{id}', 'GovMgrController@org_list_sub')->name('govmgr.org_list_sub');
    Route::post('/govmgr.org_list_sub', 'GovMgrController@org_list_sub_post')->name('govmgr.org_list_sub_post');
    Route::get('/govmgr.org_list_root', 'GovMgrController@org_list_root')->name('govmgr.org_list_root');
    Route::post('/govmgr.org_list_root', 'GovMgrController@org_list_root_post')->name('govmgr.org_list_root_post');

    Route::get('/govmgr.user_list', 'GovMgrController@user_list');

});
