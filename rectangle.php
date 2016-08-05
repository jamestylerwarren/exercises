<?php

class Rectangle {
	private $height;
	private $width;
	public function __construct($width, $height) {
		$this->height = $height;
		$this->width = $width;
	}

	public function area(){
		return ($this->height * $this->width);
	}

	public function perimeter() {
		return ($this->height * 2) + ($this->width * 2);
	}
}