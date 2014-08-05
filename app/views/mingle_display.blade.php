@extends('_master')

@Section('head')
 	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>	
 	<script>
		$(document).ready(function () {
			$( "select" ).imagepicker({show_label:true});
		})
	</script>
@stop

@section('title')
	You Picture - Mix-a-Pix
@stop

@section('content')

<?php
	$imgbinary = Mingle::imagecreatefromfile($mingle->image);
	ob_start();
	imagepng($imgbinary);
	$output = ob_get_contents();
	ob_end_clean();
	echo '<img src="data:image/gif;base64,' . base64_encode($output) . '" />';
?>
@stop
