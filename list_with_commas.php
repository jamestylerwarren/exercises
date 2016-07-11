<?php

$physicistsString = 'Gordon Freeman, Samantha Carter, Sheldon Cooper, Quinn Mallory, Bruce Banner, Tony Stark';

$physicistsArray = explode(', ', $physicistsString);
$removedArray = array_pop($physicistsArray);
$tonyStark = 'and Tony Stark';
$addedArray = array_push($physicistsArray, $tonyStark);
$famousFakePhysicists = implode(', ', $physicistsArray);

echo "Some of the most famous fictional theoretical physicists are {$famousFakePhysicists}.\n";