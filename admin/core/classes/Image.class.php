<?php

class Image {
	var $max_file_size = 2097152; #10MB
	var $allow_types = array('image/jpeg', 'image/png', 'image/gif');
	var $errors;
	
	public $destination = 'uploaded.jpeg';
	
	public $constraint = 'w';
	
	public $size = 200;
	
	public $quality = 100;
	
	public $cropwidth = false;
	public $cropheight = false;
	
	public $align;
	 
	public function __construct($imagefilepath)
	{
		$this->tmp_name = $imagefilepath;
		
		$this->image_size = filesize($this->tmp_name);
		
		$imagedata = getimagesize($this->tmp_name);
		
		
		$this->width = $imagedata[0];
		$this->height = $imagedata[1];
		
		$this->type = $imagedata['mime'];
		
		$this->is_valid = $this->is_valid_type();
		$this->is_valid = $this->is_valid_size();
		
	}
	
	
	public function is_valid_type()
	{
		if (in_array($this->type, $this->allow_types))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function is_valid_size()
	{
		if ($this->image_size['size'] <= $this->max_file_size)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function render()
	{		
		$destname = $this->destination;
		$constraint = $this->constraint;
		$new_side = $this->size;
		$cropw = $this->cropwidth;
		$croph = $this->cropheight;
		$quality = $this->quality;
		
		if ($constraint == "h") 
		{
			$new_w = ($new_side / $this->height) * $this->width;
			$new_h = $new_side;	
			
			$canvasw = ($cropw!=false) ? $cropw : $new_w;
			$canvash = ($croph!=false) ? $croph : $new_h;
		
			$canvas = imagecreatetruecolor($canvasw, $canvash);
			
			$x = ($cropw==false) ? 0 : -(($new_w - $cropw)/2);
			$y = ($croph==false) ? 0 : -(($new_h - $croph)/2);
			
		} 
		else if ($constraint == "w") 
		{
			$new_h = ($new_side / $this->width) * $this->height;
			$new_w = $new_side;
			
			$canvasw = ($cropw!=false) ? $cropw : $new_w;
			$canvash = ($croph!=false) ? $croph : $new_h;
		
			$canvas = imagecreatetruecolor($canvasw, $canvash);
			
			$x = ($cropw==false) ? 0 : -(($new_w - $cropw)/2);
			$y = ($croph==false) ? 0 : -(($new_h - $croph)/2);
		} 
		else if ($constraint == "t") 
		{
			if($this->height > $this->width)
			{
				$new_h = ($new_side / $this->width) * $this->height;
				$new_w = $new_side;

				$x = 0;
				$y = -(($new_h-$new_side)/2);
			}
			else if($this->height <= $this->width)
			{
				$new_w = ($new_side / $this->height) * $this->width;
				$new_h = $new_side;	
				
				$x = -(($new_w-$new_side)/2);
				$y = 0;
			}
			
			$canvas = imagecreatetruecolor($new_side, $new_side);
		}
		else 
		{
			$new_h = $this->height;
			$new_w = $this->width;
			
			$x = $y = 0;
			
			$canvas = imagecreatetruecolor($new_w, $new_h);
		}
		
		switch($this->type)
		{
			case 'image/jpeg':
				$ic = imagecreatefromjpeg($this->tmp_name);
				break;
				
			case 'image/gif':
				$ic = imagecreatefromgif($this->tmp_name);			
				break;
				
			case 'image/png':
				$ic = imagecreatefrompng($this->tmp_name);			
				break;
		}
		
		imagecopyResampled($canvas, 
							$ic, 
							$x, $y, 0, 0, 
							$new_w, $new_h, 
							$this->width, $this->height);
		
		imagejpeg($canvas, $destname, $quality);
		
		imagedestroy($canvas);
	}
	
	
	public function done()
	{
		unlink($this->tmp_name);
	}
	
}


?>