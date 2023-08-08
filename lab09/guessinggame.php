<?php
session_start(); // start the session

if (!isset($_SESSION["targetNumber"])) {
    $_SESSION["guesses_num"] = 0; // initialize the number of guesses
    $_SESSION["targetNumber"] = rand(1, 100); // generate a random number between 1 and 100
}
$message = "";
$guesses_num = $_SESSION["guesses_num"];
$targetNumber = $_SESSION["targetNumber"];

if (isset($_POST["guess"])) {
    $userGuess = $_POST["guess"];

    if (is_numeric($userGuess)) {
        $userGuess = intval($userGuess);

        if ($userGuess >= 1 && $userGuess <= 100) {
            $guesses_num ++;
            $_SESSION["guesses_num"] = $guesses_num ;

            if ($userGuess === $targetNumber) {
                $message .= "<p>Congratulations! You guessed the correct number!</p>";
                session_unset(); 
                session_destroy(); 
                // exit();
            } elseif ($userGuess < $targetNumber) {
                $message .="<p>Your guess is too low.</p>";
            } else {
                $message .="<p>Your guess is too high.</p>";
            }
        } else {
            $message .="<p>Please enter a number between 1 and 100.</p>";
        }
    } else {
        $message .="<p>Please enter a valid numeric value.</p>";
    }
}
?>

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
    <h1>Guessing Game</h1>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="guess">Enter a number between 1 and 100, then press the Guess button.</label>
        <input type="text" id="guess" name="guess">
        <button type="submit">Guess</button>
    </form>
    <?php echo $message; ?>
    <p>Number of Guesses: <?php echo $guesses_num>0?$guesses_num:0; ?></p>
    <p><a href="giveup.php">Give Up</a></p>
    <p><a href="startover.php">Start Over</a></p>
</body>
</html>
