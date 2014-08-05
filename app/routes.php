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

Route::get('/', 'IndexController@getIndex');


# Note: the beforeFilter for 'guest' on getSignup and getLogin is handled in the Controller
Route::get('/signup', 'UserController@getSignup'); 
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );


Route::get('/mingle', 'MingleController@getIndex');
Route::get('/mingle/display/{id}','MingleController@getDisplay');
Route::post('/mingles/add','MingleController@postAdd');


Route::get('/templates/add/', function() {
	return View::make('addtemplate');
});

Route::post('/templates/add/', function() {

	# Instantiate the book model
	$template = new Template();

	$destinationPath = "../templates/";

	$template->user_id = 1; //defaults to administrator
	$template->name = Input::get('name');
	$template->public = Input::get('public');
	$template->dst_x = Input::get('dst_x');
	$template->dst_y = Input::get('dst_y');
	$template->dst_w = Input::get('dst_w');
	$template->dst_h = Input::get('dst_h');
	$filename = Input::file('image')->getClientOriginalName();
	$filename = date('YmdHis').$filename;
	$template->image = Input::file('image')->move($destinationPath,$filename);
	$template->path = $filename;

	$template->save();
	return "Added a new template";
});


