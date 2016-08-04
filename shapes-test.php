<?php
require 'rectangle.php';
require 'square.php';


$rectangle = new rectangle(10, 5);
echo $rectangle->area() . PHP_EOL;

$square = new square(10,5);
echo $square->perimeter() . PHP_EOL;