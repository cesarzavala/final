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
	
	return Redirect::to('/debug')->with('flash_message', 'Welcome to Foobooks!');
	
}));

/*
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
*/

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
