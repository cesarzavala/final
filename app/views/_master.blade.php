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
	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Mix-a-Pix</a>
	    </div>
	</nav>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif


	@yield('content')
	
	@yield('body')
		
</body>

</html>