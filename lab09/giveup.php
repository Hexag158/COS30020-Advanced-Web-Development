<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="Nguyen Minh Nghia" content="103806269" />
<title>Guessing Game</title>
</head>
<body>
    <h1>You are a lesor</h1>

    <?php
        if (isset($_SESSION["targetNumber"])) {
            $targetNumber = $_SESSION["targetNumber"];
            echo "<p>The random number was: $targetNumber</p>";
        } else {
            echo "<p>No random number available.</p>";
        }
?>

    <p><a href="guessinggame.php">Back to Guessing Game</a></p>
</body>
</html>
