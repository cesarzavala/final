<!doctype html>
<html>
<head>

	<title>@yield('title','Final')</title>
	

	<link rel="stylesheet" href="styles/final.css" type="text/css">
	
	@yield('head')
	
</head>

<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif


	@yield('content')
	
	@yield('body')
		
</body>

</html>