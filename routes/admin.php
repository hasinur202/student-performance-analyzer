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


Route::group(['prefix'=>'/school-management', 'namespace' => 'App\Http\Controllers\Backend'], function() {  
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
    
    // Profile Routes
    Route::get('/profile', 'ProfileController@index')->name('backend.profile');
    Route::post('/profile-update', 'ProfileController@profileUpdate')->name('backend.profile.update');
    Route::get('/change-password', 'ProfileController@changePassword')->name('backend.change_password');
    Route::post('/update-password', 'ProfileController@updatePassword')->name('backend.update_password');

    // School Admin
    Route::group(['prefix' => '/user-management'], function () {
        Route::get('/school-admin/list', 'UserManagementController@index')->name('backend.school_admin');
        Route::post('/school-admin/store', 'UserManagementController@store');
        Route::post('/school-admin/toggle-status', 'UserManagementController@changeStatus');

        Route::get('/others/list', 'UserManagementController@othersIndex')->name('backend.other_users');
        Route::post('/others/store', 'UserManagementController@store');
        Route::post('/others/toggle-status', 'UserManagementController@changeStatus');
    });

});
