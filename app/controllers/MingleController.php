<?php

class MingleController extends BaseController {
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();		
		# Only logged in users should have access to this controller
		//$this->beforeFilter('auth');
	}

public function getIndex() {
	$user = Auth::user();
	if ($user->id > 1) {
		$mingles = Mingle::where('user_id','=',$user->id)->get();
	} else {
		$mingles = Mingle::all();
	};

	return View::make('mingle_index')->with('mingles', $mingles);
}

public function getDisplay($id) {
	$user = Auth::user();
	$mingle = Mingle::where('mingle_id','=',$id)->get()->first();
	$mingle_user_id = $mingle['user_id'];
	if(($user->id=1) or ($user->id=$mingle_user_id)) {
		return View::make('mingle_display')->with('mingle',$mingle);
	} else {
		return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized to see that picture, please contact the administrator.');
	}
}

public function postAdd() {

	# Step 1) Define the rules			
	$rules = array(
		'image' => 'required|min:1'
	);	

	# Step 2) 		
	$validator = Validator::make(Input::all(), $rules);
	
	# Step 3
	if($validator->fails()) {
		
		return Redirect::to('/')
			->with('flash_message', 'Please select a valid image')
			->withInput()
			->withErrors($validator);
	}

	# Instantiate the book model
	$picture = new Picture();

	$destinationPath = "../pictures/";

	if(Auth::check()){
		$user = Auth::user();
	} else {
		$user = User::all()->first();
	};
	
	$user_id = $user->id;


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


	$mingle = Mingle::withTemplateAndPicture($template, $picture);

	$dest = $mingle->do_mingle($filename);	

	return View::make('mingle_add')->with('image',$dest);


}


}