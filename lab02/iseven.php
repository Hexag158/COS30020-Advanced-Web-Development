<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Programming :: Lab 2" />
<meta name="keywords" content="Web,programming" />
<meta name="Nghia" content="103806269">
</head>
<body>
<?php
    $number = $_GET["number"];
    if (is_numeric($number))
    {
        if ($number == 0)
        {
            echo "The variable $number <b>is a</b> number!";
        }
        elseif (round($number)%2 == 0)
        {
            echo "The variable $number <b>is even</b> number!";
        }
        else {
            echo "The variable $number <b>is odd</b> number!";
        } 
    }
    else{
        echo "The variable $number <b>is not</b> a number";
    }
    ?>
    <form action="formiseven.php" method="get"> 
            <input type="submit" value="Try other"/>  
    </form>
</body>
</html>