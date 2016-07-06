<?php

// foreach (range(1, 100) as $i) {
//     if ($i % 2 == 0) {
//     	echo $i . "\n";
//         continue;
//     }
// }

foreach (range(1, 100) as $i) {
	echo $i . "\n";
    if ($i == 10) {
        break;
    }
}