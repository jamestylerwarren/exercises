<?php

//Problem One:
// $num = 25;

// function square($num) {
// 	$message = "false" . PHP_EOL;
// 	for ($i=0; $i < $num; $i++) { 
// 		if ($i * $i == $num) {
// 			$message = "true" . PHP_EOL;
// 		} 
// 	}
// 	return $message;
// }
// print square($num);





//Problem 4:
$pin = '7611';
function pincheck($pin) {
	$message = 'true' . PHP_EOL;
	if (strlen($pin) < 4 || strlen($pin) > 6) {
		$message = 'false' . PHP_EOL; 
	}
	if (strcspn($pin, 'ABCDEFGHJIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz') < 0) {
		$message = 'false' . PHP_EOL;
	}
	return $message;
}
print pincheck($pin);














