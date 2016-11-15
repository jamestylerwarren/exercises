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


// Looking for a benefactor
// function newAvg($arr, $newavg) {
//     $n = count($arr);
//     $new_tot = $newavg * ($n + 1);
//     $curr_tot = 0;
//     $i = 0;
//     while ($i < $n) {
//       $curr_tot += $arr[$i];
//       $i++;
//     }
//     if ($curr_tot < $new_tot) {
//       return ceil($new_tot - $curr_tot);
//     } else {
//       throw new InvalidArgumentException();
//     }
// }
// var_dump(newAvg([14, 30, 5, 7, 9, 11, 15], 92));



