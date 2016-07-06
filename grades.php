<?php

// Variables
// $name; 
// $grade; 
// $average;
// var_dump($name);




// Input
function input($student) {
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
}

echo input($student);



// Process
$average = round(calculateAverage(), 2);
// Output
if ($average > $student['awesomeGrade'] {
    echo "$student['name'] you are awesome!!!! Your average was $average\n";
} else {
    echo "$student['name'] you need more practice. Your average was $average\n";
}


// Object definition
$student = ['awesomeGrade' => 80, 'name' => null, 'subjects' => []];


function calculateAverage() {
    $average = 0;
    this.subjects.forEach(function (subject) {
    $average += subject.grade;
    });
    return $average / this.subjects.length;
}
    
function addSubject($name, $grade) {
    $subject = {
        name: name,
        grade: grade
    };
    this.subjects.push(subject);
},
    
function isAwesome() {
    return this.calculateAverage() > this.awesomeGrade;
}




