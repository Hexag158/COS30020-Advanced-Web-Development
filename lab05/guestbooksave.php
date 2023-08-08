<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="NGUYEN MINH NGHIA" content="103806269" />
<title>WEB-DEV LAB 5 TASK 1</title>
</head>
<body>
<h1>Web Programming Form - Lab 5 - TASK 2 - SIGN GUEST BOOK</h1>
<?php
    $guestbookFile = "../../data/guestbook.txt";

    if (!empty($_POST["first-name"]) && !empty($_POST["last-name"])) {
        $firstName = $_POST["first-name"];
        $lastName = $_POST["last-name"];

        if (!empty($firstName) && !empty($lastName) && !is_numeric($firstName) && !is_numeric($lastName)) {
            $guestName = $firstName . "," . $lastName . PHP_EOL;

            if ($fileHandle = fopen($guestbookFile, "a")) {
                fwrite($fileHandle, $guestName);
                fclose($fileHandle);
                echo "Thank you for signing the Guest book";
            } else {
                echo "Cannot add your name to the Guest book";
            }
        } else {
            echo "Error: Please enter both your first and last names.<br>";
            
        }
    } else {
        echo "Error: Please fill in both your first and last names.<br>";
    
    }
?>
</form>
<p><a href="guestbookform.php">Guest Book Form</a></p>
<p><a href="guestbookshow.php">Show Guest Book</a></p>
</body>
</html>