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

Route::get('/mysql-connection-test', function() {
	$results = DB::select('SHOW DATABASES;');
	print_r($results);
});

/*-------------------------------------------------------------------------------------------------
// !get signup
-------------------------------------------------------------------------------------------------*/
Route::get('/signup',
	array(
		'before' => 'guest',
		function() {
	    	return View::make('signup');
		}
	)
);


/*-------------------------------------------------------------------------------------------------
// !post signup
-------------------------------------------------------------------------------------------------*/
Route::post('/signup', array('before' => 'csrf', function() {

	$user = new User;
	$user->email    = Input::get('email');
	$user->password = Hash::make(Input::get('password'));
	
	try {
		$user->save();
	}
	catch (Exception $e) {
		return Redirect::to('/signup')
			->with('flash_message', 'Sign up failed; please try again.')
			->withInput();
	}
	
	# Log in
	Auth::login($user);
	
	return Redirect::to('/')->with('flash_message', 'Welcome to Foobooks!');
	
}));


Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


Route::get('/testpic', function(){
	$dest = imagecreatefrompng('../test/FrameTopBottom.png');
	$src = imagecreatefrompng('../test/NiagaraFalls.png');

	$size = getimagesize('../test/NiagaraFalls.png');

	
	//imagealphablending($dest, false);
	//imagesavealpha($dest, true);

	//imagecopymerge($dest, $src, 0, 0, 0, 0, 1200, 800, 100); //have to play with these numbers for it to work for you, etc.

	//imagecopyresized($dest, $src, 0, 0, 0, 0, 1200, 800, $size[0], $size[1]);
	imagecopyresized($dest, $src, 10, 110, 0, 0, 1200, 800, $size[0], $size[1]);


	header('Content-Type: image/png');
	imagepng($dest);

	imagedestroy($dest);
	imagedestroy($src);
});


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

	$picture->user_id = 1; //defaults to administrator
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

	$filename = Input::file('image')->getClientOriginalName();
	$filename = date('YmdHis').$filename;
	$picture->image = Input::file('image')->move($destinationPath,$filename);

	$picture->save();
	//return "Added a new picture";

	$template = Template::where('template_id','=',5)->get()->first();
	$mingle = new Mingle($template, $picture);
	$mingle->do_mingle($filename);

});

Route::get('/ui/', function() {
	return View::make('ui');
});
