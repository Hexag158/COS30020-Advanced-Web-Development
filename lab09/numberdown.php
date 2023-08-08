<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="Nguyen Minh Nghia" content="103806269" />
<title>Lab 09</title>
</head>
<body>
    <?php
        session_start(); // start the session
        $num = $_SESSION["number"]; // copy the value to a variable
        $num--; // decrement the value
        $_SESSION["number"] = $num; // update the session variable
        header("location: number.php"); // redirect to number.php
    ?>
</body>
</html>