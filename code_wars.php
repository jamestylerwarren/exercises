<?php
//CODE WARS PROBLEMS;

// getting median of array;
// function median($a) {
//   sort($a);
//   $count = count($a);
//   if ($count % 2 == 0){
//     $elementOne = $count/2 - 1;
//     $elementTwo = $count/2;
//     $median = ($a[$elementTwo] + $a[$elementOne])/2;
//     print($median);
//   }
//   if ($count % 2 != 0) {
//     $middleElement = $count/2 - .5;
//     print($a[$middleElement]);
//   }
// }
// median([10, 29, 23, 94, 76, 96, 5, 85, 4, 33, 47, 41, 87]);


function compose($s1, $s2) {
    //explode strings into arrays
    $s1 = explode("\n", $s1);
    $s2 = explode("\n", $s2);
    
    var_dump($s1);



    //last step is imploding all array keys into a string;
}

$s1 = "byGt\nhTts\nRTFF\nCnnI";
$s2 = "jIRl\nViBu\nrWOb\nNkTB";
compose($s1, $s2);