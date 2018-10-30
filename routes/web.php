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
        'middleware' => ['age', 'stub'],
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
        Route::post('password/reset',        	'ResetPasswordController@reset')->name('password.reset.post');
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
        Route::get('/',               'DashboardController@index')->name('dashboard');

        // Users
        Route::get('users/data',      'UsersController@data')->name('users.data');
        Route::resource('users',      'UsersController')->names([
            'index'   => 'users.index',
            'show'    => 'users.show',
            'update'  => 'users.update',
        ]);

        // Presents
        Route::get('presents/render',       'PresentsController@render')->name('presents.render');
        Route::post('presents',             'PresentsController@store')->name('presents');
        Route::delete('presents/{present}', 'PresentsController@destroy')->name('presents.delete');

        // Exports
        Route::get('exports',               'ExportsController@index')->name('exports.index');
        Route::post('exports/invited',      'ExportsController@invited')->name('exports.invited');
        Route::post('exports/top',          'ExportsController@top')->name('exports.top');
    });

    // App routes
    Route::group([
        'namespace'  => 'App',
        'middleware' => ['age', 'stub'],
    ], function () {
        // Age Gate
    	// Route::get('age',       'AppController@age')->name('age');

        // Home
        Route::get('/',         'AppController@index')->name('home')->middleware('invite');

        // Game
        Route::get('/game',          'GameController@game')->name('game');
        Route::get('/game_iframe',   'GameController@iframe')->name('game.iframe');

        // User
        Route::get('user',          'UsersController@user')->name('user')->middleware('auth:web');
        Route::get('history',       'UsersController@history')->name('history')->middleware('auth:web');
        // Route::get('winners',       'UsersController@winners')->name('winners');       
    });

    Route::get('age',           'App\AppController@age')->name('age')->middleware('age');
    Route::get('winners',       'App\UsersController@winners')->name('winners')->middleware('age');
    Route::get('stub',          'App\AppController@stub')->name('stub')->middleware('age');

    Route::group([
        'namespace'  => 'App',
        'middleware' => ['stub'],
    ], function () {

        // Game
        Route::get('/game_results',  'GameController@checkAuth')->name('game.check_auth');
        Route::post('/game_results', 'GameController@results')->name('game.results');

        // User
        Route::get('invite/{user}',  'UsersController@invite')->name('invite');
    });
});
