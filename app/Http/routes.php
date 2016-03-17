<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

	Route::resource('/articles', 'PostController');

	Route::resource('/projects', 'ProjectController');

	Route::resource('/contact', 'ContactController');

	Route::resource('/profile', 'ProfileController');

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

	Route::group(['prefix' => 'projects'], function(){
		//Route pour custom function in controller
		Route::post('/{id}', [
			'as' => 'projects.updateStatus', 
			'uses' => 'ProjectController@updateStatus'
		]);
	});

	Route::group(['prefix' => 'articles'], function(){
		Route::post('/{id}', [
			'as' => 'articles.storeComment', 
			'uses' => 'PostController@storeComment'
		]);
		Route::delete('/{id}', [
			'as' => 'articles.destroyComment', 
			'uses' => 'PostController@deleteComment'
		]);
	});

    Route::auth();

    Route::get('/home', 'HomeController@index');
});
