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
        function factorial ($n) { // declare the factorial function
            $result = 1; // declare and initialise the result variable
            $factor = $n; // declare and initialise the factor variable
            while ($factor > 1) { // loop to multiple all factors until 1
                $result = $result * $factor;
                $factor--; // next factor
            } // Note that the factor 1 is not multiplied
            return $result;
            }
    ?>
</body>
</html>