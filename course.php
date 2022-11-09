<?php
include_once "./classes/CourseClass.php";
include_once "./studentsInCourse.php";

if (isset($_GET["show"])) {

    $courseCSVArray = courseArrayFromFile("./csv/course.csv");
    
    $courseoArray = courseArrayToObj($courseCSVArray);
    
    showCourseTable($courseoArray);
}

function courseArrayFromFile($path) {
    $csvArr = array_map("str_getcsv", file($path));
    return $csvArr;
}

function courseArrayToObj($CSVarr, $CorArr = array()) {
    if (count($CorArr) == 0) {
        $tempCorArr = array();
        $tempCorArr = CorArrayFromFile("./csv/studentInCourse.csv");
        $CorArr = CorArrayToObj($tempCorArr);
    }
    $oArr = array();
    foreach ($CSVarr as &$course) {
        $newCourse = new Course($course[0], $course[1], $course[2], $course[3], $course[4], $course[5], 0, 0, 0, 0);
        
        $newCourse->numStudents = $newCourse->findNumStudents($CorArr);
        $newCourse->numStudentsPassed = $newCourse->findNumStudentsPassed($CorArr);
        $newCourse->numStudentsFailed = $newCourse->findNumStudentsFailed($CorArr);
        $newCourse->averageGrade = $newCourse->avgGrade($CorArr);
        
        array_push($oArr, $newCourse);
    }

    $oArr = validateCourseArray($oArr);
    usort($oArr, "enrolledComparator");
    return $oArr;
}

function validateCourseArray($array) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
         if (!in_array($val->courseCode, $key_array)) {
            $key_array[$i] = $val->courseCode;
            $temp_array[$i] = $val;
        }
        $i++; 
    }
    return $temp_array;
}

function enrolledComparator($object1, $object2) { 
    return $object1->numStudents > $object2->numStudents; 
} 

function showCourseTable($courseArr) {
    echo "<table>
    <tr>
        <th>Course code</th>
        <th>Course name</th>
        <th>Year</th>
        <th>Semester</th>
        <th>Instructor</th>
        <th>Credits</th>
        <th>Students registered</th>
        <th>Students passed</th>
        <th>Students failed</th>
        <th>Average grade</th>
    </tr>"; 
    foreach ($courseArr as &$course) {
        $course->__toString();
    }
    echo "</table>";
}


?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div>
        <a href="student.php?show=true" class="button">Show students</a>  
        <a href="index.php" class="button">Back</a>
    </div>
</body>