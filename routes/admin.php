<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=>'/institute-management', 'namespace' => 'App\Http\Controllers\Backend'], function() {  
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
    
    // Profile Routes
    Route::get('/profile', 'ProfileController@index')->name('backend.profile');
    Route::post('/profile-update', 'ProfileController@profileUpdate')->name('backend.profile.update');
    Route::get('/change-password', 'ProfileController@changePassword')->name('backend.change_password');
    Route::post('/update-password', 'ProfileController@updatePassword')->name('backend.update_password');

    // Institute Admin
    Route::group(['prefix' => '/user-management'], function () {
        Route::get('/institute-admin/list', 'UserManagementController@index')->name('backend.institute_admin');
        Route::post('/institute-admin/store', 'UserManagementController@store');
        Route::post('/institute-admin/toggle-status', 'UserManagementController@changeStatus');

        Route::get('/others/list', 'UserManagementController@othersIndex')->name('backend.other_users');
    });


    // Institute Info Routes
    Route::group(['prefix' => '/institute-info'], function () {
        Route::get('/list', 'InstituteInfoController@index')->name('backend.institute_info');
        Route::get('/add', 'InstituteInfoController@add')->name('backend.institute_info.add');
        Route::get('/edit/{id}', 'InstituteInfoController@edit')->name('backend.institute_info.edit');
        Route::post('/store', 'InstituteInfoController@store');
        Route::post('/toggle-status', 'InstituteInfoController@changeStatus');
    });

    // Master Class routes
    Route::group(['prefix' => '/class'], function () {
        Route::get('/list', 'MasterClassController@index')->name('backend.class');
        Route::post('/store', 'MasterClassController@store');
        Route::post('/toggle-status', 'MasterClassController@changeStatus');
    });

    // Master Group routes
    Route::group(['prefix' => '/group'], function () {
        Route::get('/list', 'MasterGroupController@index')->name('backend.group');
        Route::post('/store', 'MasterGroupController@store');
        Route::post('/toggle-status', 'MasterGroupController@changeStatus');
    });

    // Master Section routes
    Route::group(['prefix' => '/section'], function () {
        Route::get('/list', 'MasterSectionController@index')->name('backend.section');
        Route::post('/store', 'MasterSectionController@store');
        Route::post('/toggle-status', 'MasterSectionController@changeStatus');
    });

    // Master Subject routes
    Route::group(['prefix' => '/subject'], function () {
        Route::get('/list', 'MasterSubjectController@index')->name('backend.subject');
        Route::post('/store', 'MasterSubjectController@store');
        Route::post('/toggle-status', 'MasterSubjectController@changeStatus');
    });

});
