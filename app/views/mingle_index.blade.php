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
	Your Pictures - Mix-a-Pix
@stop

@section('content')

<?php if(Auth::check()) { ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Your stored Mix-a-Pixes</h3>
				  </div>
				  <div class="panel-body minglesset">
				  <?php 
							foreach($mingles as $mingle) {
								$imgbinary = Mingle::imagecreatefromfile($mingle->image);
								ob_start();
								imagepng($imgbinary);
								$output = ob_get_contents();
								ob_end_clean();
								$mingle_id = $mingle->toArray()['mingle_id'];
								echo '<a href="/mingle/display/'.$mingle_id.'"><img src="data:image/gif;base64,' . base64_encode($output) . '" /></a>';
							};
				  ?>
				  </div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
@stop
