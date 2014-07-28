<?php

class Picture extends Eloquent {
	
	#Relationship with user
	public function user(){
		return $this->belongsTo('User');
	}
	

}

?>