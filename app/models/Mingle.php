<?php

class Mingle extends Eloquent {

	var $picture;
	var $template;

	#Relationship with user
	public function user(){
		return $this->belongsTo('User','id');
	}
	
	#Relationship with picture
	public function picture() {
		return $this->belongsTo('Picture','id');
	}

	#Relationship with template
	public function template() {
		return $this->belongsTo('Template','id');
	}

	public function __construct($thetemplate, $thepicture) {
		$this->template = $thetemplate;
		$this->picture = $thepicture;
	}

	public function do_mingle($filename) {

			$dest = imagecreatefrompng($this->template->image);
			$src = imagecreatefrompng($this->picture->image);

			$size = getimagesize($this->picture->image);

	
			imagecopyresized($dest, $src, 10, 110, 0, 0, 1200, 800, $size[0], $size[1]);

			$destinationPath = "../mingles/";

			//print_r($destinationPath.$filename);
			//dd();

			header('Content-Type: image/png');
			//imagepng($dest, $destinationPath.$filename);

			imagepng($dest);
			imagedestroy($dest);
			imagedestroy($src);

	}




}

?>