
@extends('_master')

@section('title')
	Add a picture
@stop

@section('content')

	<h1>Add a New Picture</h1>


	{{ Form::open(array('url' => '/pictures/add/', 'method' => 'POST', 'files' => true)) }}

		Picture Name: {{ Form::text('name') }} <br>
		Region horizontal start position: {{ Form::text('src_x') }} <br>
		Region vertical start position: {{ Form::text('src_y') }} <br>
		Region width: {{ Form::text('src_w') }} <br>
		Region height: {{ Form::text('src_h') }} <br>

		File: {{ Form::file('image')}}

		{{ Form::submit('Save Picture') }}

	{{ Form::close() }}


@stop

