<?php

$names = ['Tina', 'Dana', 'Mike', 'Amy', 'Adam'];

$compare = ['Tina', 'Dean', 'Mel', 'Amy', 'Michael'];

$query = 'Tina';

function arraySearch($query, $names) {
	if (array_search($query, $names) !== False) {
		echo "true\n";
	} else {
		echo "false\n";
	}
} arraySearch($query, $names);




 // if (array_search($query, $names)) {
 // 	var_dump("True");
 // } else {
 // 	var_dump("False");
 // }
	


