<?php

$num = 2;
do {
	echo $num . PHP_EOL;
	$num *= $num;
} while ($num <= 1000000);