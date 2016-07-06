<?php

// Variables
// $name; 
// $grade; 
// $average;
// var_dump($name);
// Object definition

$student = array(
    'awesomeGrade' => 80, 
    'name' => null, 
    'subjects' => array()
);



// Input
function input(&$student) {
    fwrite(STDOUT, 'What is your name? ') . PHP_EOL;
    $name = trim(fgets(STDIN));
    $student['name'] = $name;
    do {
        fwrite(STDOUT, 'What is the name of the subject? ') . PHP_EOL;
        $subject = trim(fgets(STDIN));
        $student['subjects'] = $subject;

        fwrite(STDOUT, 'What is your grade? ') . PHP_EOL;
        $grade = trim(fgets(STDIN));

        fwrite(STDOUT, 'Do you want to add another grade? ') . PHP_EOL;
        $anotherGrade = trim(fgets(STDIN));
    } while (strtolower($anotherGrade) == 'yes' || strtolower($anotherGrade) == 'y');
} echo input($student);

// echo input($student);

//---------- Adding subjects to student array ---------//    
function addSubject($name, $grade) {
    $student['subjects'] = [
        $name => 'name',
        $grade => 'grade'
    ];
    $subject = $student['subjects'];
    var_dump($name);
    var_dump($grade);
}


//-------- Calculating average ----------------//
function calculateAverage($student) {
    $average = 0;
    foreach ($student as $subject) {
        $average += $subject['grade'];
    };
    return $average / count($student);
    var_dump($average);

}
    




//----------- Calculating Average --------------------//
var_dump(gettype($average) );
$average = round(calculateAverage($student), 2);
// Output
if ($average > $student['awesomeGrade']) {
    echo "{$student['name']} you are awesome!!!! Your average was $average.\n";
} else {
    echo "{$student['name']} you need more practice. Your average was $average.\n";
}

print_r($student);

// function isAwesome() {
//     return this.calculateAverage() > this.awesomeGrade;
// }

