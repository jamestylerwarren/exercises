<?php
require_once 'rectangle.php';

class square extends rectangle {
	public $perimeter;
	public function perimeter(){
		$perimeter = ($this->height * 2) + ($this->width * 2);
		return $perimeter;  
	}
}