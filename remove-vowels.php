<?php


$array = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i'];

function removeVowels(&$array) {
	foreach ($array as $key => $letter) {
		if ($letter == 'a' || $letter == 'e' || $letter == 'i' || $letter == 'o' || $letter == 'u') {
			unset($array[$key]);
		}
	}
	return $array;
}
var_dump(removeVowels($array));


$noVowels = preg_repace('aeiou', '', $array);
