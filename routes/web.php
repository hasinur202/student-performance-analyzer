<?php

use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    return 'cache clear';
});

Route::get('/version', function () {
    return 'Laravel Version => '.app()->version();
});

//download file path from storage
Route::get('/download-attachment', [DownloadController::class, 'downloadFile']);


Route::group(['prefix'=>'/', 'namespace' => 'App\Http\Controllers\Frontend'], function() {  
    // Home
    Route::get('/', 'HomeController@index')->name('frontend.home');

    // Register
    Route::get('/register', 'RegisterController@index')->name('frontend.register');
});

Route::group(['middleware' =>['guest']], function () {
    Route::group(['prefix'=>'/admin', 'namespace' => 'App\Http\Controllers\Auth'], function() {  
        // Login
        Route::get('/login', 'LoginController@index')->name('auth.login');
        // Register
        Route::get('/register', 'RegisterController@index')->name('auth.register');
        // user-sign-in
        Route::post('/sign-in', 'LoginController@userSignIn')->name('auth.signin');
        // user sign-up
        Route::post('/sign-up', 'LoginController@userSignUp')->name('auth.signup');
    });

});

Route::group(['middleware' => ['auth']], function () {

    // Route::get('/fileDownload/{file}', [ParentController::Class, 'downloadFile']);
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('auth.signout');

    include('admin.php');
});


