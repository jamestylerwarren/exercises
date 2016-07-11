<?php

$physicistsString = 'Gordon Freeman, Samantha Carter, Sheldon Cooper, Quinn Mallory, Bruce Banner, Tony Stark';

$physicistsArray = explode(', ', $physicistsString);

// $removedArray = array_pop($physicistsArray);
// $andTonyStark = 'and Tony Stark';
// $addedArray = array_push($physicistsArray, $andTonyStark);
// $famousFakePhysicists = implode(', ', $physicistsArray);

// echo "Some of the most famous fictional theoretical physicists are {$famousFakePhysicists}.\n";


function humanizedList($array, $alphabatize = false) {
	if ($alphabatize) {
		sort($array);
	}
	$lastItem = array_pop($array);
	$lastItemString = 'and ' . $lastItem;
	array_push($array, $lastItemString);
	$arrayToString = implode(', ', $array);
	return ($arrayToString);	
} 

$famousFakePhysicists = humanizedList($physicistsArray, true);

echo "Some of the most famous fictional theoretical physicists are {$famousFakePhysicists}.\n";

