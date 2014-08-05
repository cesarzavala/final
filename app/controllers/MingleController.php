<?php

class MingleController extends BaseController {
	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();		
		# Only logged in users should have access to this controller
		$this->beforeFilter('auth');

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


}