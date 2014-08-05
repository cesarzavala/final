<?php

class Template extends Eloquent {

    protected $primaryKey = 'template_id';


	#Relationship with user
	public function user(){
		return $this->belongsTo('User','user_id','id');
	}
}
	
?>