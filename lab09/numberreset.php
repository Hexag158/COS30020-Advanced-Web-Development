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
        session_unset();// unset all session variables
        session_destroy(); // destroy all data associated with the session
        header("location: number.php"); // redirect to number.php
    ?>
</body>
</html>