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
    });

    Route::group([
        'namespace'  => 'Auth\App',
        'middleware' => ['age'],
    ], function () {

        // Auth
        Route::get('auth',                      'LoginController@login')->name('login');
        Route::post('auth',                     'LoginController@loginPost')->name('login.post');
        Route::get('auth/{provider}',           'RegisterController@redirectToProvider')->name('login.social');
		Route::get('auth/{provider}/callback',  'RegisterController@handleProviderCallback')->name('login.social.callback');
        Route::get('registration',              'RegisterController@register')->name('register');
        Route::post('registration',             'RegisterController@create')->name('register.post');
        Route::get('registration/social',       'RegisterController@registerFromSocial')->name('register.social');
        Route::post('registration/social', 		'RegisterController@createFromSocial')->name('register.social.post');
        Route::get('registration/{token}',      'RegisterController@confirm')->name('register.confirm');
        Route::get('logout',                    'LoginController@logout')->name('logout');

        // Passwords Resets
        Route::post('password/email',        	'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset',         	'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/reset',        	'ResetPasswordController@reset')->name('password.resetPost');
        Route::get('password/reset/{token}', 	'ResetPasswordController@showResetForm')->name('password.reset');
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
        'namespace'  => 'App',
        'middleware' => ['age'],
    ], function () {
    	Route::get('age',       'AppController@age')->name('age');

        Route::get('/',         'AppController@index')->name('home');

        Route::get('user',         'AppController@user')->name('user')->middleware('auth:web');
    });
    
});
