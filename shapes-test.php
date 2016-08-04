<?php
require 'rectangle.php';
require 'square.php';


$rectangle = new rectangle(20, 10);
echo $rectangle->area() . ' is rectangle area' . PHP_EOL;
echo $rectangle->perimeter() . ' is rectangle perimeter' . PHP_EOL;

$square = new square(10,10);
echo $square->area() . ' is square area' . PHP_EOL;
echo $square->perimeter() . ' is square perimeter' . PHP_EOL;