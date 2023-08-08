<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Application Development :: Lab 1" />
<meta name="keywords" content="Web,programming" />
<meta name="Nghia" content="103806269">
<title>Leap year check</title>
</head>
<body>  

    <h1>Lab 03 Task 3 - Prime Number</h1>
    <?php
        if (isset ($_GET["primenumber"]) && is_numeric($_GET["primenumber"]) && is_int($_GET["primenumber"]) ) 
        { 
                $number = $_GET["primenumber"]; // obtain the form data
                $flag = true;

                    for ($x = 2; $x <= $number / 2; $x++)
                        if ($number % $x ==0)
                        {
                            $flag = false;
                            break;
                        }
                    if ($flag){
                        echo $number," is a prime number";
                    }
                    else {
                        echo $number," is not a prime number";
                    }
                }
        else { // no input
            echo "<p>Please enter a integer .</p>";
        }
    ?>
</body>
</html>