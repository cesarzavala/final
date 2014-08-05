@extends('_master')

@section('title')
	Edit Frame - Mix-a-Pix
@stop

@section('content')

	{{ Form::open(array('url' => '/frames/edit','role' => 'form-group')) }}

	<input type="hidden" name="template_id" value="<?php echo $template->template_id ?>">

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Edit Frame</h3>
				  </div>
				  <div class="panel-body">
					  <span class="help-block">Frames are essential for the application. Edit the name or the position (x,y) or size (width, height) of the destination of the image that will be mixed.</span>				  
					  <div class="form-group">
					    <label for="name">Name</label>
					    <input name="name" type="text" class="form-control" id="name" placeholder="Enter name" value="<?php echo $template->name ?>">
					  </div>
					  <div class="form-group">
					    <label for="dst_x">Position X</label>
					    <input name="dst_x" type="text" class="form-control" id="dst_x" placeholder="Enter position x" value="<?php echo $template->dst_x ?>">
					  </div>
					  <div class="form-group">
					    <label for="dst_y">Position Y</label>
					    <input name="dst_y" type="text" class="form-control" id="dst_y" placeholder="Enter position y" value="<?php echo $template->dst_y ?>">
					  </div>
					  <div class="form-group">
					    <label for="dst_w">Width</label>
					    <input name="dst_w" type="text" class="form-control" id="dst_w" placeholder="Enter target image width" value="<?php echo $template->dst_w ?>">
					  </div>
					  <div class="form-group">
					    <label for="dst_h">Height</label>
					    <input name="dst_h" type="text" class="form-control" id="dst_h" placeholder="Enter target image height" value="<?php echo $template->dst_h ?>">
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