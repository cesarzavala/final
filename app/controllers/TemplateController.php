<?php

class TemplateController extends BaseController {

	public function __construct() {
		# Make sure BaseController construct gets called
		parent::__construct();		
		# Only logged in users should have access to this controller
		$this->beforeFilter('auth');
	}

	public function getIndex() {
		if(Auth::check()) {
			if(Auth::user()->id==1) {
				$templates = Template::all();
					return View::make('template_index')
						->with('templates', $templates);
			} else {
				return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
			};
		} else {
			return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
		}
	}

	public function getEdit($id) {
		if(Auth::check()) {
			if(Auth::user()->id==1) {
				$template = Template::where('template_id','=',$id)->get()->first();
					return View::make('template_edit')
						->with('template', $template);
			} else {
				return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
			};
		} else {
			return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
		}		
	}

	public function postEdit() {
		if(Auth::check()) {
			if(Auth::user()->id==1) {
				$id = Input::get('template_id');
				$template = Template::where('template_id','=',$id)->get()->first();
				$template->name = Input::get('name');
				$template->template_id = $id;
				$template->save();
				return Redirect::action('TemplateController@getIndex')->with('flash_message','Your changes were saved');

			} else {
				return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
			};
		} else {
			return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
		}		
	}

	public function getCreate() {
		if(Auth::check()) {
			if(Auth::user()->id==1) {
				return View::make('template_add');
			} else {
				return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
			};
		} else {
			return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
		}			
	}

	public function postCreate() {
		if(Auth::check()) {
			if(Auth::user()->id==1) {

				$rules = array(
					'name' => 'required|unique:templates,name',
					'dst_x' => 'required|numeric|min:0',
					'dst_y' => 'required|numeric|min:0',
					'dst_w' => 'required|numeric|min:0',
					'dst_h' => 'required|numeric|min:0',
					'image' => 'required|min:1'
				);					

				# Step 2) 		
				$validator = Validator::make(Input::all(), $rules);
	
				# Step 3
				if($validator->fails()) {
					
					return Redirect::to('/frames/add')
						->with('flash_message', 'Please fix the errors')
						->withInput(Input::except('image'))
						->withErrors($validator);
				}

				$template = new Template();

				$destinationPathImage = "../templates/";
				$destinationTemplateDir = "/templates/";
				$destinationPublic = "../public/templates/";

				$template->user_id = 1; //defaults to administrator
				$template->name = Input::get('name');
				$template->public = 1;
				$template->dst_x = Input::get('dst_x');
				$template->dst_y = Input::get('dst_y');
				$template->dst_w = Input::get('dst_w');
				$template->dst_h = Input::get('dst_h');
				$filename = Input::file('image')->getClientOriginalName();
				$filename = date('YmdHis').$filename;
				//$template->image = Input::file('image')->move($destinationPublic,$filename);				
				$template->image = Input::file('image')->move($destinationPathImage,$filename);
				$template->path = $destinationTemplateDir.$filename;

				File::copy($destinationPathImage.$filename,$destinationPublic.$filename);

				$template->save();

				return Redirect::action('TemplateController@getIndex')->with('flash_message','The frame was added successfully');


			} else {
				return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
			};
		} else {
			return Redirect::action('IndexController@getIndex')->with('flash_message','You are not authorized for this page, please contact the administrator.');
		}			
	}


}

?>