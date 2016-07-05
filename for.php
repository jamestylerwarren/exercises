<?php

fwrite(STDOUT, 'Please enter a starting number. ') . PHP_EOL;
$startingNum = trim(fgets(STDIN));
fwrite(STDOUT, 'Please enter an ending number. ') . PHP_EOL;
$endingNum = trim(fgets(STDIN));

for ($i = $startingNum + 1; $i < $endingNum; $i++) {
	echo $i . PHP_EOL;
}