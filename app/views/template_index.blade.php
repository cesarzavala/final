@extends('_master')

@section('title')
	Frames - Mix-a-Pix
@stop

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Manage Frames</h3>
				  </div>
				  <div class="panel-body">
				  		<a href="/frames/add">Add frames</a>
				  		<span class="help-block">Click the name of the frame to edit it.</span>				  
						<?php
							foreach($templates as $template) {
								echo '<h3><a href="/frames/edit/'.$template->template_id.'">'.$template->name.'</a></h3><div class="thumbnail"><img  src="'.$template->path.'"></div>';
							}
						?>
				  </div>
				</div>
			</div>
		</div>
	</div>


@stop