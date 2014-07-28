
@extends('_master')

@section('title')
	Add a template
@stop

@section('content')

	<h1>Add a New Template</h1>


	{{ Form::open(array('url' => '/templates/add/', 'method' => 'POST', 'files' => true)) }}

		Template Name: {{ Form::text('name') }} <br>
		Public: {{ Form::checkbox('public','1') }} <br>
		Region horizontal start position: {{ Form::text('dst_x') }} <br>
		Region vertical start position: {{ Form::text('dst_y') }} <br>
		Region width: {{ Form::text('dst_w') }} <br>
		Region height: {{ Form::text('dst_h') }} <br>

		File: {{ Form::file('image')}}

		{{ Form::submit('Save Template') }}

	{{ Form::close() }}


@stop

