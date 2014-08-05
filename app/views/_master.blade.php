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
	  		<h2><a href="/">Mix-a-Pix</a></h2>
	  		<h4>Choose your picture, select a frame and Mix-a-Pix!</h4>
	  		<div class="login">
	  			@if(Auth::check())
        			<span class="label label-default">Logged in as <strong>{{{Auth::user()->email}}}</strong></span> - 
        			{{link_to('mingle','Saved pictures')}} - 
					{{link_to('logout', 'Log Out')}}
      			@else
        			{{link_to('login', 'Log In')}} - 
        			{{link_to('signup', 'Sign Up to save your pictures')}}
      			@endif
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