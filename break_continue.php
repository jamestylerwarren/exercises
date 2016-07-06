<?php

foreach (range(1, 100) as $i) {
    echo $i . "\n";
    if ($i == 10) {
        break;
    }
}