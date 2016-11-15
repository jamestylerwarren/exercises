<?php
$int = 11252;
function sumOfDigits($int) {
	if(!is_numeric($int)){
		$int = intval($int);
	}
	$sum = 0;
	do {
	    $sum += $int % 10;
	}
	while ($int = (int)$int / 10);
	return $sum . PHP_EOL;
}
print sumOfDigits($int);