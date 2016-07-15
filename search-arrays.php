<?php

$names = ['Tina', 'Dana', 'Mike', 'Amy', 'Adam'];

$compare = ['Tina', 'Dean', 'Mel', 'Amy', 'Michael'];

// $query = 'Tina';

// function arraySearch($query, $names) {
// 	if (array_search($query, $names) !== False) {
// 		echo "true\n";
// 	} else {
// 		echo "false\n";
// 	}
// }
// arraySearch($query, $names);



function compareArrays($names, $compare) {
	$count = 0;
	foreach ($names as $name) {
		if (array_search($name, $compare) !== false) {
			$count++;
		}
	}
	return ($count) . PHP_EOL;
} 
echo compareArrays($names, $compare);

$num = 3;
var_dump($num++);
	


	


