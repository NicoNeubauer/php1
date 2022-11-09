<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Assigment 1</title>
</head>

<body>
        <div>
                <h2>Assigment 1</h2>
                <form action="data.php" method="post" enctype="multipart/form-data" id="csvForm">   
                        <a href="student.php?show=true" class="button">Show students</a>
                        <a href="course.php?show=true" class="button">Show courses</a>
                        <a href="upload.php" class="button">Upload CSV File</a>
                </form>
        </div>
        <div>
                <h3>What is this page?</h3>
                <p>
                This is a PHP page where the user can input CVS filse that 
                contain <br>  student information.
                These files will generate tables with <br>
                containig the student information.
                </p>
        </div>

</body>
</html>
