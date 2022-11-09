
<?php
include_once "./classes/StudentClass.php";
include_once "./studentsInCourse.php";

if (isset($_GET["show"])) {

    $studentCSVArray = studArrayFromFile("./csv/student.csv");
    $obj = 
    $studentoArray = studArrayToObj($studentCSVArray);

    showStudTable($studentoArray);
}

function studArrayFromFile($path) {
    $csvArr = array_map("str_getcsv", file($path));
    return $csvArr;
}


function studArrayToObj($CSVarr, $CorArr = array()) {
    if (count($CorArr) == 0) {
        $tempCorArr = array();
        $tempCorArr = CorArrayFromFile("./csv/studentInCourse.csv");
        $CorArr = CorArrayToObj($tempCorArr);
    }
    $oArr = array();
    foreach ($CSVarr as &$stud) {
        $newStud = new Student($stud[0], $stud[1], $stud[2], $stud[3], 0, 0, 0, 0); 
        
        $newStud->coursesCompleted = $newStud->findCoursesCompleted($CorArr);
        $newStud->coursesFailed = $newStud->findCoursesFailed($CorArr);
        $newStud->GPA = $newStud->calculateGPA($CorArr);
        $newStud->status = $newStud->findStatus($newStud->GPA);

        array_push($oArr, $newStud);
    }

    $oArr = validateStudentArray($oArr);
    usort($oArr, "GPAComparator");
    return $oArr;
}

function validateStudentArray($array) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
         if (!in_array($val->studentNo, $key_array)) {
            $key_array[$i] = $val->studentNo;
            $temp_array[$i] = $val;
        }
        $i++; 
    }
    return $temp_array;
} 

function GPAComparator ($a, $b){
    return $a->GPA < $b->GPA;
}

function showStudTable($studArr) {
    echo "<table>
        <tr>
            <th>Student Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Course completed</th>
            <th>Course failed</th>
            <th>GPA</th>
            <th>Status</th>
        </tr>";
    foreach ($studArr as &$stud) {
        $stud->__toString();
    }
    echo "</table>";
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">    
</head>
<body>
    <div>
        <a href="course.php?show=true" class="button">Show courses</a>  
        <a href="index.php" class="button">Back</a>
    </div>
</body>