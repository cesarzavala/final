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

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

# Note: the beforeFilter for 'guest' on getSignup and getLogin is handled in the Controller
Route::get('/signup', 'UserController@getSignup'); 
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );
Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );


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

Route::get('/pictures/add/', function() {
	return View::make('addpicture');
});

Route::post('/pictures/add/', function() {

	# Instantiate the book model
	$picture = new Picture();

	$destinationPath = "../pictures/";

	$user = User::all()->first();
	$user_id = $user->user_id;


	$template = Input::get('template');

	$picture->user_id = $user_id; //defaults to administrator
	$picture->name = Input::get('name');
	if (!isset($picture->name)) {
		$picture->name = "testing";
	}
	$picture->src_x = Input::get('src_x');
	If (!isset($picture->src_x)) {
		$picture->src_x = 0;
	}
	$picture->src_y = Input::get('src_y');
	If (!isset($picture->src_y)) {
		$picture->src_y = 0;
	}	
	$picture->src_w = Input::get('src_w');
	If (!isset($picture->src_w)) {
		$picture->src_w = 0;
	}	
	$picture->src_h = Input::get('src_h');
	If (!isset($picture->src_h)) {
		$picture->src_h = 0;
	}
	$template_id = Input::get('template');
	If (!isset($template_id)) {
		$template_id = 1;
	}

	$filename = Input::file('image')->getClientOriginalName();
	$filename = date('YmdHis').$filename;
	$picture->image = Input::file('image')->move($destinationPath,$filename);

	$picture->save();
	//return "Added a new picture";

	$template = Template::where('template_id','=',$template_id)->get();


	$mingle = new Mingle($template, $picture);

	$mingle->do_mingle($filename);

});

Route::get('/ui/', function() {
	return View::make('ui');
});
