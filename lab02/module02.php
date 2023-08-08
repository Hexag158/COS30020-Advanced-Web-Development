<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Programming :: Lab 2" />
    <meta name="keywords" content="Web,programming" />
    <meta name="Nghia" content="103806269">
    <title>Using variables, arrays and operators</title>
</head>
<body>
<h1>Web Programming - Lab 2</h1>
<?php
    $marks = array (85, 85, 95); // declare and initialise array
    $marks[1] = 90; // modify second element
    $ave = ($marks[0] + $marks[1] + $marks[2]) / 3; // compute average
    $status = ($ave >= 50)? "PASSED": "FAILED" ;// checks status
    echo "<p>The average score is $ave. You $status</p>";
?>
</body>
</html>