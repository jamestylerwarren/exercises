<?php
require_once 'rectangle.php';

class Square extends rectangle {

	public function __construct($side)
	{ 
        parent::__construct($side, $side); //gives construct function same parameter, which sets both height and width to same value
    }

	// public function perimeter(){
	// 	return ($this->height * 2) + ($this->width * 2); 
	// }

	// public function area(){
	// 	$area = ($this->height * $this->width);
	// 	return $area;
	// }
	//can take out perimeter and area functions from this class. Because area and perimeter are in parent, they are available to its children (square in this case)
}