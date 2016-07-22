<?php

//Problem One:
$numInteger = 8;

function toNumber($numInteger) {
	switch ($numInteger){
		case '1':
			echo 'one';
			break;
		case '2':
			echo 'two';
			break;
		case '3':
			echo 'three';
			break;
		case '4':
			echo 'four';
			break;
		case '5':
			echo 'five';
			break;
		case '6':
			echo 'six';
			break;
		case '7':
			echo 'seven';
			break;
		case '8':
			echo 'eight';
			break;
		default:
			echo 'nine';
	}
}
toNumber($numInteger);


//problem two:

$integerOne = 100;
$integerTwo = 40;

function greatestDiviser($integerOne, $integerTwo)
{
    while ($integerTwo != 0)
    {
        $modulus = $integerOne % $integerTwo;
        $integerOne = $integerTwo;
        $integerTwo = $modulus;
    }
    return $integerOne;
}
print_r(greatestDiviser($integerOne, $integerTwo));


//problem three:
$fibonacci = 21;
$j = $fibonacci - 1;
$i = $fibonacci - 2;















