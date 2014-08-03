@extends('_master')

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
		<select class="image-picker show-html">
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
	<script>
		$("select").imagepicker();
	</script>
