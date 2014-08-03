@extends('_master')

@Section('head')
	<script>
		$(document).ready(function () {
	  		$("select").imagepicker();	
		})
	</script>
@stop

@section('title')
	Add a picture
@stop

@section('content')

	<h1>Add a New Picture</h1>


	{{ Form::open(array('url' => '/pictures/add/', 'method' => 'POST', 'files' => true)) }}

		Picture Name: {{ Form::text('name') }} <br>
		File: {{ Form::file('image')}}

		{{ Form::submit('Save Picture') }}

	<div class="container-fluid">
		<select name="template" class="image-picker show-html">
<?php
	$templates = Template::all();
	foreach($templates as $template) {
		echo '<option data-img-src="'.$template->path.'" value="'.$template->template_id.'">'.$template->name.'</option>';
	}
?>
		</select>

	</div>
	{{ Form::close() }}
@stop


