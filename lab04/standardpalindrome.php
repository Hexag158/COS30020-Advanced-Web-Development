<?php 
        if (isset ($_POST["standardpalindrome"])) {
            // Get the word or phrase from the form input
            $input = $_POST["standardpalindrome"];

            $input = str_replace(['.', ',', '!', '?', ';', ':', '-', '(', ')', '[', ']', '{', '}'], '', $input);

            // Convert the input to lowercase
            $input = strtolower($input);

            // Reverse the input
            $reversed = strrev($input);

            // Compare the original input with the reversed one
            if (strcmp($input, $reversed) === 0) {
                $is_palindrome = true;
            } else {
                $is_palindrome = false;
            }
        }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Nguyen Minh Nghia - 103806269" />

</head>
<body>
    <h1>Web Programming - Lab 4 - TASK 3</h1>
    <form action = "standardpalindrome.php" method = "post" >
    Enter a string: <input type="text" name="standardpalindrome"/>  
    <input type="submit" value="Check"/>  
</form>
    <p><?php
    if ($is_palindrome) {
        echo $input," is a standard palindrome.";
    } else {
        echo $input," is not a standard palindrome.";
    }
    ?></p>
</html>