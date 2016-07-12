<?php

$letters = ['e', 'a', 'g', 'c', 'i', 'd', 'f', 'b', 'h'];

function alphabetize($letters) {
	for ($i = 0; $i < count($letters); $i++) {
		for ($j = $i + 1; $j < count($letters); $j++) { 
			if ($letters[$j] < $letters[$i]) {
				$oldI = $letters[$i];
				$letters[$i] = $letters[$j];
				$letters[$j] = $oldI;
			}
		}
	}
	return $letters;
} print_r(alphabetize($letters));