@extends('_master')

@section('title')
	Add Frame - Mix-a-Pix
@stop

@section('content')

	@foreach($errors->all() as $message) 
		<div class='flash-message'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/frames/add','role' => 'form-group','files' => true)) }}

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Add Frame</h3>
				  </div>
				  <div class="panel-body">
					  <span class="help-block">Frames are essential for the application. Upload an image that will serve as a frame for the images uploaded. Specify the position (x,y) and the size (width, height) where the uploaded image will be put inside the frame image.</span>				  
					  <div class="form-group">
					    <label for="image">Image</label>
					    <input name="image" type="file" class="form-control" id="image" placeholder="Choose frame image">
					  </div>
					  <div class="form-group">
					    <label for="name">Name</label>
					    <input name="name" type="text" class="form-control" id="name" placeholder="Enter name">
					  </div>
					  <div class="form-group">
					    <label for="dst_x">Position X</label>
					    <input name="dst_x" type="text" class="form-control" id="dst_x" placeholder="Enter position x" >
					  </div>
					  <div class="form-group">
					    <label for="dst_y">Position Y</label>
					    <input name="dst_y" type="text" class="form-control" id="dst_y" placeholder="Enter position y" >
					  </div>
					  <div class="form-group">
					    <label for="dst_w">Width</label>
					    <input name="dst_w" type="text" class="form-control" id="dst_w" placeholder="Enter target image width" >
					  </div>
					  <div class="form-group">
					    <label for="dst_h">Height</label>
					    <input name="dst_h" type="text" class="form-control" id="dst_h" placeholder="Enter target image height" >
					  </div>

				  </div>

				</div>
			</div>
		</div>
	</div>


	<div class="row mybutton">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</div>

	
	{{ Form::close() }}

@stop