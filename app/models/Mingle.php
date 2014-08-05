<?php

class Mingle extends Eloquent {

	var $picture;
	var $template;

	#Relationship with user
	public function user(){
		return $this->belongsTo('User','user_id','id');
	}
	
	#Relationship with picture
	public function picture() {
		return $this->belongsTo('Picture','picture_id','picture_id');
	}

	#Relationship with template
	public function template() {
		return $this->belongsTo('Template','template_id','template_id');
	}

	public static function withTemplateAndPicture($thetemplate, $thepicture) {
		$instance = new self();
		$instance->template = $thetemplate;
		$instance->picture = $thepicture;
		return $instance;
	}

//http://stackoverflow.com/questions/10233577/create-image-from-url-any-file-type
	public static function imagecreatefromfile( $filename ) {
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }
    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
        break;

        case 'png':
            return imagecreatefrompng($filename);
        break;

        case 'gif':
            return imagecreatefromgif($filename);
        break;

        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
        break;
    }
}

	public function do_mingle($filename) {

			$this_template = $this->template->first();
			$image= $this_template->image;
			$dst_x = $this_template->dst_x;
			$dst_y = $this_template->dst_y;
			$dst_w = $this_template->dst_w;
			$dst_h = $this_template->dst_h;

			$dest = imagecreatefrompng($image);
			$src = $this->imagecreatefromfile($this->picture->image);

			$size = getimagesize($this->picture->image);
	
			imagecopyresized($dest, $src, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $size[0], $size[1]);


			$filename = date('YmdHis') + rand(0,getrandmax());
			$destinationPath = "../mingles/".$filename.".png";
			imagepng($dest,$destinationPath);

			if(Auth::check()){
				$this->user_id = Auth::user()->id;
			} else {
				$this->user_id = 1;
			};

			$this->picture_id = $this->picture->id;
			$this->template_id = $this_template->template_id;
			$this->path = $destinationPath;
			$this->image = $this->path;

			$this->save();
			
			header('Content-Type: image/png');
			//imagepng($dest, $destinationPath.$filename);

			imagepng($dest);
			imagedestroy($dest);
			imagedestroy($src);



	}




}

?>