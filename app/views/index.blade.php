@extends('_master')

@Section('head')
 	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>	
 	<script>
		$(document).ready(function () {
			$( "select" ).imagepicker({show_label:true});
		})
	</script>
@stop

@section('title')
	Mix-a-Pix - Final - Cesar Zavala
@stop

@section('content')

	{{ Form::open(array('url' => '/mingles/add/', 'method' => 'POST', 'files' => true)) }}

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Your picture</h3>
				  </div>
				  <div class="panel-body">
				    {{ Form::file('image')}}
				  </div>
				</div>
			</div>
		</div>
		<div class="row mybutton">
			<button type="submit" class="btn btn-primary">Mix-a-Pix</button>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Frames</h3>
				  </div>
				  <div class="panel-body">

					<select name="template" class="image-picker show-labels">
						<?php
							$templates = Template::all();
							foreach($templates as $template) {
								echo '<option data-img-label="<h3>'.$template->name.'</h3>" data-img-src="'.$template->path.'" value="'.$template->template_id.'">'.$template->name.'</option>';
							}
						?>
					</select>
				  </div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row mybutton">
			<button type="submit" class="btn btn-primary">Mix-a-Pix</button>
		</div>
	</div>	


	{{ Form::close() }}
@stop
