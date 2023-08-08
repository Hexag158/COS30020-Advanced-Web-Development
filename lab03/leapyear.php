<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Application Development :: Lab 1" />
<meta name="keywords" content="Web,programming" />
<meta name="Nghia" content="103806269">
<title>Leap year check</title>
</head>
<body>
    <?php
        include ("is_leapyear.php");
    ?>   
    <h1>Lab 03 Task 2 - Leap Year</h1>
    <?php
        if (isset ($_GET["year"]) and $_GET["year"] > 0 ) 
        { // check if form data exists
            $year = $_GET["year"]; // obtain the form data
            $check_year = is_leapyear($year);

            if ($check_year == true)
            {
                echo $year," is a leap year";
            }
            else
                echo $year," is not a leap year";
        } 
        else { // no input
            echo "<p>Please enter a year.</p>";
        }
    ?>
</body>
</html>