<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', 'UsersController@getLogin');
Route::post('login', 'UsersController@postLogin');

Route::get('logout', 'UsersController@getLogout');

Route::group(array('before' => 'auth'), function(){
	
	Route::controller('users', 'UsersController');
	Route::controller('articles', 'ArticlesController');
	Route::controller('stats', 'StatsController');
	Route::controller('campaigns', 'CampaignsController');
	Route::controller('settings', 'SettingsController');

	Route::get('dashboard', 'DashboardController@getIndex');
});

Route::get('/', function(){
	return Redirect::to('dashboard');
});