<?php

foreach (range(1, 100) as $i) {
    echo $i . "\n";
    if ($i % 2 !== 0) {
        continue;
    }
    echo "^ that is an even number.\n";
}