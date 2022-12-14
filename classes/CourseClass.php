<?php
class Course {
    function __construct($courseCode, $courseName, $year, $semester, $instructor, $credits, 
                        $numStudents, $numStudentsPassed, $numStudentsFailed, $averageGrade) {
        $this->courseCode = $courseCode;    // Primary key (Composite key)
        $this->courseName = $courseName;
        $this->year = $year;                // Primary key (Composite key)
        $this->semester = $semester;        // Primary key (Composite key)
        $this->instructor = $instructor;
        $this->credits = $credits;
        $this->numStudents = $numStudents;
        $this->numStudentsPassed = $numStudentsPassed;
        $this->numStudentsFailed = $numStudentsFailed;
        $this->averageGrade = $averageGrade;
    }

    public function __toString(){
        echo "<tr>
            <td>" . $this->courseCode . "</td>
            <td>" . $this->courseName . "</td>
            <td>" . $this->year . "</td>
            <td>" . $this->semester . "</td>
            <td>" . $this->instructor . "</td>
            <td>" . $this->credits . "</td>
            <td>" . $this->numStudents . "</td>
            <td>" . $this->numStudentsPassed . "</td>
            <td>" . $this->numStudentsFailed . "</td>
            <td>" . $this->averageGrade . "</td>
        </tr>";
    }
    



    public function findNumStudentsPassed($arr) {
        $tempArr = array();
        $studentCount = 0;
        foreach ($arr as &$stud) {
            if ($stud->grade != "F" && $stud->courseCode == $this->courseCode) {
                $stud->grade = strtoupper($stud->grade);
                array_push($tempArr, $stud);
            }
        }
        $studentCount = count($tempArr);
        return $studentCount;
    }

    public function tudentFailed($arr) {

        $tempArr = array();
        foreach ($arr as &$stud) {
            if ($stud->grade == "F" && $stud->courseCode == $this->courseCode) {
                $stud->grade = strtoupper($stud->grade);
                array_push($tempArr, $stud);
            }
        }
        return count($tempArr);
    }

    public function avgGrade($arr) {
        $grades = ["F", "E", "D", "C", "B", "A"];
        $gradeTemp = array();
        $tempSum = 0;
        $tempCount = 0;
        $avgGrade = "";
        foreach ($arr as &$stud) {
            if ($stud->courseCode == $this->courseCode) {
                $stud->grade = strtoupper($stud->grade);
                $point = array_search($stud->grade, $grades);
                array_push($gradeTemp, $point);
            }
        }
        if(count($gradeTemp)) {
            
            $tempSum = array_sum($gradeTemp);
            $tempCount = count($gradeTemp);

            $gradeTemp = array_filter($gradeTemp);
            $average = $tempSum / $tempCount;
            
        } 
        $avgGrade = $grades[round($average)];
        return $avgGrade;
    }
    
    public function findNumStudents($arr) {
        $tempArr = array();
        $count = 0;
        foreach ($arr as &$course) {
            if ($course->courseCode == $this->courseCode){
                $count++;
            }
        }
        return $count;
    }
}

?>