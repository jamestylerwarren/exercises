<?php

$a = 20;
$b = 5;

function add($a, $b)
{	
	if (is_numeric($a) && is_numeric($b)) {
    	return $a + $b;
	} else {
		return "ERROR";
	}
}

function subtract($a, $b)
{
    if (is_numeric($a) && is_numeric($b)) {
    	return $a - $b;
	} else {
		return "ERROR";
	}
}

function multiply($a, $b)
{
    if (is_numeric($a) && is_numeric($b)) {
    	return $a * $b;
	} else {
		return "ERROR";
	}
}

function divide($a, $b)
{	
	if ($b == 0) {
		return "\$a = $a \n\$b = $b\n";
	} elseif (is_numeric($a) && is_numeric($b)) {
    	return $a / $b;
	}
}

function modulus($a, $b) 
{
	if (is_numeric($a) && is_numeric($b)) {
    	return $a % $b;
	} else {
		return "ERROR";
	}
}




echo add(10, 2) . PHP_EOL;
echo subtract(10, 2) . PHP_EOL;
echo multiply(10, 2) . PHP_EOL;
echo divide(10, 0) . PHP_EOL;
echo modulus(10, 2) . PHP_EOL;