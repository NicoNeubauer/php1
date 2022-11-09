<?php
class StudentInCourse {
    function __construct($studentNo, $courseCode, $year, $semester, $grade, $credit) {
        $this->studentNo = $studentNo;      // Primary key (Composite key) Foreign key from student
        $this->courseCode = $courseCode;    // Primary key (Composite key) Foreign key from courses
        $this->year = $year;                
        $this->semester = $semester;        
        $this->grade = $grade;
        $this->credit = $credit;
    }
}
?>