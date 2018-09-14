<?php

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

Route::group([
    'middleware' => ['localization'],
    'prefix'     => LaravelLocalization::setLocale(),
], function() {	

    Route::group([
        'namespace' => 'Auth\Admin',
        'prefix'    => 'admin',
        'as'        => 'admin.'
    ], function () {

        // Auth
        Route::get('auth',                   'LoginController@login')->name('login');
        Route::post('auth',                  'LoginController@loginPost')->name('login.post');
        Route::get('logout',                 'LoginController@logout')->name('logout');

        // // Passwords Resets
        // Route::post('password/email',        'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        // Route::get('password/reset',         'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('password/reset',        'ResetPasswordController@reset')->name('password.resetPost');
        // Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });

    Route::group([
        'namespace' => 'Auth\App',
    ], function () {

        // // Auth
        // Route::get('auth',                   'LoginController@login')->name('login');
        // Route::post('auth',                  'LoginController@loginPost')->name('login.post');
        // Route::get('logout',                 'LoginController@logout')->name('logout');

        // // Passwords Resets
        // Route::post('password/email',        'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        // Route::get('password/reset',         'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('password/reset',        'ResetPasswordController@reset')->name('password.resetPost');
        // Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    });

    // Admin routes
    Route::group([
        'namespace'  => 'Admin',
        'middleware' => ['auth:admin'],
        'prefix'     => 'admin',
        'as'         => 'admin.'
    ], function () {
        // Dashboard
        Route::get('/',                        'DashboardController@index')->name('dashboard');      
    });

    // App routes
    Route::group([
        'namespace' => 'App',
    ], function () {
        Route::get('/',                           'AppController@index')->name('home');
    });
    
});
