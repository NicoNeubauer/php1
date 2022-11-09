
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<h2>Upload a csv file</h2>
<div class="updiv">
    <label for="filebutton">Choose File</label>
    <div class="updiv">
        <!-- On the input i choose what kind of file i accept in my system -->
        <input type="file" accept=".csv" name="file" id="file" class="input-large" class="upButton">
    </div>
    </div>

<div class="updiv">
    <label  for="submit">Upload</label>
    <br>
    <button type="submit" id="submit" name="submit" value="submit" class="button">Upload</button>  
</div>



<div class="updiv">
        <a href="course.php?show=true" class="button">Courses</a> 
        <a href="student.php?show=true" class="button">Students</a> 
        <a href="index.php" class="button">Back</a>
</div>


<?php

// here i take the uploaded file and split int into parts to wotk with.
//
if (isset($_GET["upload"])) {
    if ($_GET["upload"] == true) {
        echo "Upload done";
    } else {
        echo "no good";
    }
}


?>

<?php

if ( isset($_POST["submit"]) ) {
    if ( isset($_FILES["file"]) ) {
        if ($_FILES["file"]["error"] > 0) {
             echo "file error";
        } else {
            echo "done";

            $fileName = $_FILES["file"]["name"];
            
            if ($_FILES["file"]["size"] > 0) {
                $fh = fopen($_FILES["file"]["tmp_name"], "r+");
                $importArray = array();
                
                
                while( ($row = fgetcsv($fh)) !== FALSE ) {
                    $importArray[] = $row;
                }
                $CorArr = ModArray($importArray, "Cor");
                $studArr = ModArray($importArray, "stud");
                $courseArr = ModArray($importArray, "course");
                

                writeTo($CorArr, "./csv/studentInCourse.csv");
                writeTo($studArr, "./csv/student.csv");
                writeTo($courseArr, "./csv/course.csv");
                
                header("Location: index.php?upload=true");   
            }
        }
    } else {
            echo "file";
    }
}


function ModArray($arr, $value) {
    if ($value == "stud") {
        $studArr = array();
        $studCsv = studArrayFromFile("./csv/student.csv");
        if (count($studCsv) != 0) {
            foreach($studCsv as &$cStud) {
                array_push($studArr, $cStud);
            }
        }
        
        foreach($arr as &$stud) {
            array_push($studArr, array($stud[0], $stud[1], $stud[2], $stud[3]));
        }
       
        return $studArr;
    }
    if ($value == "course") {
        $courseArr = array();
        $courseCsv = courseArrayFromFile("./csv/course.csv");
        if (count($courseCsv) != 0) {
            foreach($courseCsv as &$cCourse) {
                array_push($courseArr, $cCourse);
            }
        }
       
        foreach($arr as &$course) {
            array_push($courseArr, array($course[4], $course[5], $course[6], $course[7], $course[8], $course[9]));
        }
       
        return $courseArr;
    }
    if ($value == "Cor") {
        $CorArr = array();
        $CorCsv = CorArrayFromFile("./csv/studentInCourse.csv");
        if (count($CorCsv) != 0) {
            foreach($CorCsv as &$cCor) {
                array_push($CorArr, $cCor);
            }
        
        
        }
        foreach($arr as &$Cor) {
            array_push($CorArr, array($Cor[0], $Cor[4], $Cor[6], $Cor[7], $Cor[10], $Cor[9]));
        }
        return $CorArr;
    }
}

function writeTo($arr, $path) {
    $csv_file = fopen($path, "w");
   
    foreach ($arr as &$fields) {
        fputcsv($csv_file, get_object_vars($fields));
    }
    fclose($csv_file);
}
?>