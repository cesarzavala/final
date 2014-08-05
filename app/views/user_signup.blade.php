@extends('_master')

@section('title')
	Sign up
@stop

@section('content')
	
	@foreach($errors->all() as $message) 
		<div class='flash-message'>{{ $message }}</div>
	@endforeach
	
	{{ Form::open(array('url' => '/signup','role' => 'form-group')) }}
				
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Sign Up</h3>
				  </div>
				  <div class="panel-body">
					  <div class="form-group">
					    <label for="email">Email</label>
					    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
					  </div>
					  <div class="form-group">
					    <label for="password">Password</label>
					    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
					  </div>						
				  </div>
				</div>
			</div>
		</div>
		<div class="row mybutton">
			<button type="submit" class="btn btn-primary">Sign Up</button>
		</div>
	</div>

	
	{{ Form::close() }}

@stop