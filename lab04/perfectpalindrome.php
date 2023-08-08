<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Nguyen Minh Nghia - 103806269" />

</head>
<body>
    <h1>Web Programming - Lab 4</h1>
    <?php 
        if (isset ($_POST["palindrome"])) {
            // Get the word or phrase from the form input
            $input = $_POST["palindrome"];

            // Convert the input to lowercase
            $input = strtolower($input);

            // Reverse the input
            $reversed = strrev($input);

            // Compare the original input with the reversed one
            if (strcmp($input, $reversed) === 0) {
                echo $input," is a perfect palindrome.";
            } else {
                echo $input," is not a perfect palindrome.";
            }
        }
        else {
            echo "<p>Please enter string from the input form.</p>";
        }
?>  
</html>