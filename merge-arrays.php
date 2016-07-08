<?php

$names = ['Tina', 'Dana', 'Mike', 'Amy', 'Adam'];

$compare = ['Tina', 'Dean', 'Mel', 'Amy', 'Michael'];

function combine_arrays($names, $compare) {
	$new_Array = [];
	for ($i=0; $i < count($compare); $i++) {
		if ($names[$i] !== $compare[$i]) {
			array_push($new_Array, $names[$i], $compare[$i]);
		} else {
			array_push($new_Array, $names[$i]);
		}
	}
	return $new_Array;
}
var_dump(combine_arrays($names, $compare));