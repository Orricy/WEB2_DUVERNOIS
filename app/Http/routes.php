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

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::group(['prefix' => 'articles'], function(){
		/*Route::get('/', function () {
		    return view('articles.index');
		});

		Route::get('/create', function () {
		    return view('articles.create');
		});

		Route::get('/{id}', function ($id) {
		    return 'articles no.'.$id;
		});

		Route::post('/', [
			'as' => 'articles.store', 
			'uses' => function (Request $request){
		    	dd($request->all());
			}
		]);*/
	});

    Route::auth();

    Route::get('/home', 'HomeController@index');
});
