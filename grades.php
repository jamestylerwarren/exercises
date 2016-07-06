<?php

// Variables
// $name; 
// $grade; 
// $average;
// var_dump($name);
// Object definition

$student = [
    'awesomeGrade' => 80, 
    'name' => null, 
    'subjects' => []
];



// Input
function input(&$student) {
    fwrite(STDOUT, 'What is your name? ') . PHP_EOL;
    $name = trim(fgets(STDIN));//saving response as name
    $student['name'] = $name; //adding response to array
    do {
        fwrite(STDOUT, 'What is the name of the subject? ') . PHP_EOL;
        $subject = trim(fgets(STDIN)); //saving response as subject

        fwrite(STDOUT, 'What is your grade? ') . PHP_EOL;
        $grade = trim(fgets(STDIN));   //saving response as grade
        $student['subjects'][$subject] = $grade; //Adding a new array containing subject and grades into $students['subjects'] array

        fwrite(STDOUT, 'Do you want to add another grade? ') . PHP_EOL;
        $anotherGrade = trim(fgets(STDIN));
    } while (strtolower($anotherGrade) == 'yes' || strtolower($anotherGrade) == 'y');
} echo input($student);


//---------- Adding subjects to student array ---------//    
// function addSubject($name, $grade) {
//     $subject = [
//         $name => 'name',
//         $grade => 'grade'
//     ];
//     $subject = $student['subjects'];
// }


//-------- Calculating average ----------------//
function calculateAverage($student) {
    $total = 0;
    foreach ($student['subjects'] as $subject => $grade) {
        $total += $grade; //looking into $student['subjects'] and looking at grades; adding them up and saving as $total
    }
    $average = $total / count($student['subjects']);
    return $average;

}

//----------- Evaluating Average --------------------//

$average = round(calculateAverage($student), 2);
// Output
if ($average > $student['awesomeGrade']) {
    echo "{$student['name']} you are awesome!!!! Your average was $average.\n";
} else {
    echo "{$student['name']} you need more practice. Your average was $average.\n";
}

// print_r($student);

// function isAwesome() {
//     return this.calculateAverage() > this.awesomeGrade;
// }

