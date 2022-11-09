<?php
include_once "./classes/StudentInCourseClass.php";

function CorArrayFromFile($path) {
    $csvArr = array_map("str_getcsv", file($path));
    return $csvArr;
}

function CorArrayToObj($CSVarr) {
    $oArr = array();
    foreach ($CSVarr as &$Cor) {
        $newCor = new StudentInCourse($Cor[0], $Cor[1], $Cor[2], $Cor[3], $Cor[4], $Cor[5]);
        array_push($oArr, $newCor);
    }
    return $oArr;
}


?>