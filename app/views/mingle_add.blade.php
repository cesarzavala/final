@extends('_master')

@section('title')
	Mix-a-Pix
@stop

@section('content')

<?php
	ob_start();
	imagepng($image);
	$output = ob_get_contents();
	ob_end_clean();
	echo '<img src="data:image/gif;base64,' . base64_encode($output) . '" />';
?>
@stop
