<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','Final')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="/image-picker/image-picker.js"></script>
	<link rel="stylesheet" href="/image-picker/image-picker.css">
	<link rel="stylesheet" href="/styles.css">
	@yield('head')	
</head>

<body>

<div class="panel panel-default logo">
  	<div class="panel-body">
	  	<div class="row">
	  		<div class="col-sm-6">
		  		<h2>Mix-a-Pix</h2>
		  	</div>
		  	<div class="col-sm-6 hidden-xs rightlogo"> 
		  		@if(Auth::check())
					<h4 class="rightie"><span class="label label-default rightie">Logged in as <strong>{{{Auth::user()->email}}}</strong></span></h4>		  	
		  		@endif
		  	</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h4>Choose your picture, select a frame and Mix-a-Pix!</h4>
			</div>
			<div class="col-sm-6 hidden-xs rightlogo">
		  		<a href="/"><span class="glyphicon glyphicon-home"></span></a>	- 		
		  		<h4 class="rightie">
		  			@if(Auth::check())
	        			{{link_to('mingle','Saved pictures')}} - 
						{{link_to('logout', 'Log Out')}}
	      			@else
	        			{{link_to('login', 'Log In')}} - 
	        			{{link_to('signup', 'Sign Up to save your pictures')}}
	      			@endif
		  		</h4>		
			</div>
		</div>
		<!-- Extra row for extra small devices only -->
		<div class="row visible-xs-block">
			<div class="col-sm-12">
		  		<h4>
		  			@if(Auth::check())
		        		<span class="label label-default">Logged in as <strong>{{{Auth::user()->email}}}</strong></span>
		        		<div class="breather">
							<a href="/"><span class="glyphicon glyphicon-home"></span></a> - 		  		
		        			{{link_to('mingle','Saved pictures')}} - 
							{{link_to('logout', 'Log Out')}}
						</div>
	      			@else
						<a href="/"><span class="glyphicon glyphicon-home"></span></a> - 		  		
	        			{{link_to('login', 'Log In')}} - 
	        			{{link_to('signup', 'Sign Up to save your pictures')}}
	      			@endif
		  		</h4>	
			</div>
		</div>
	</div>
</div>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif


	@yield('content')
	
	@yield('body')
		
</body>

</html>