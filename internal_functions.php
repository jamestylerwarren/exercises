<?php

// TODO: Create your inspect() function here

function inspect($a) {
	switch (gettype($a)) {
		case 'integer':
			$value = intval($a);
			return "This integer is $value";
			break;
		case 'float':
			$value = floatval($a);
			return "This float is $value";
			break;
		case 'boolean':
			$value = boolval($a);
			if ($value) {
				return "This boolean is true";
			} else {
				return "This boolean is false";
			}
			break;
		case 'array':
			$value = empty($a);
			if ($value) {
				return "This array is empty"; 
			} else {
				return 'This is an array: ' . implode(', ', $a);
			}
			break;
		case 'NULL':
			return "This is null";
			break;
		case 'string':
			if ($a == '' || $a == "") {
			return "This is an empty string";
			} else {
			return "This string says: $a";
			}
			break;
		case 'double':
			$value = floatval($a);
			return "This double is $value";
			break;
		default:
			return "IDK what this is";
			break;
	}
}

// Do not mofify these variables!
$string1 = "I'm a little teapot";
$string2 = '';
$array1 = [];
$array2 = [1, 2, 3];
$bool1 = true;
$bool2 = false;
$num1 = 0;
$num2 = 0.0;
$num3 = 12;
$num4 = 14.4;
$null = NULL;

// TODO: After each echo statement, use inspect() to output the variable's type and its value

echo 'Inspecting $num1: ' . inspect($num1) . PHP_EOL;

echo 'Inspecting $num2: ' . inspect($num2) . PHP_EOL;

echo 'Inspecting $num3: ' . inspect($num3) . PHP_EOL;

echo 'Inspecting $num4: ' . inspect($num4) . PHP_EOL;

echo 'Inspecting $null: ' . inspect($null) . PHP_EOL;

echo 'Inspecting $bool1: ' . inspect($bool1) . PHP_EOL;

echo 'Inspecting $bool2: ' . inspect($bool2) . PHP_EOL;

echo 'Inspecting $string1: ' . inspect($string1) . PHP_EOL;

echo 'Inspecting $string2: ' . inspect($string2) . PHP_EOL;

echo 'Inspecting $array1: ' . inspect($array1) . PHP_EOL;

echo 'Inspecting $array2: ' . inspect($array2) . PHP_EOL;	
