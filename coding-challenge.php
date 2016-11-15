<?php


//problem 1:


//problem 2:

//problem 3:
// function triangles($x){
// 	$answer = (pow($x,3))/((1-(pow($x,2)))*(1-(pow($x,3)))*(1-(pow($x,4))));
// 	return $answer . PHP_EOL;
// }
// $x = 20;
// print(triangles($x));

//problem 4:
function coordinates($lat, $long){
	if (!is_numeric($lat) || !is_numeric($long)) {
		echo "FALSE" . PHP_EOL;
	}
	if ($lat < -90 || $lat > 90 || $long < -180 || $long > 180) {
		echo "FALSE" . PHP_EOL;
	}
	echo "TRUE" . PHP_EOL;
}
print_r(coordinates( - 2, 1));

//problem 5:













