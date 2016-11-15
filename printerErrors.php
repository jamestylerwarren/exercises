<?php

//Printer Errors
function printerError($s) {
	//length of total $s;
	$length = strlen($s);
	//split string into individual characters
	$array = str_split($s);
	//start a counter
	$i = 0;
	//invalid character list
	$invalid = ['n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
	//compare each character to invalid characters
	foreach ($array as $key => $value) {
		foreach ($invalid as $k => $v) {
			//if they match, increase counter; if not continue;
			if ($value == $v) {
				$i++;
			}
		}
	}
	//get invalid characters and length of string and return in format needed;
	return $i . "/" . $length;
}

$s = "kkkwwwaaaaaaaaaaaaaabbbbbbbbbbbbbbbbbbmmmmmmmmmmmmmmmmmmmxyzuuuuu";
print(printerError($s));