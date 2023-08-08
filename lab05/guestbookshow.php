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
<h1>Web Programming Form - Lab 5 - TASK 2 - SHOW GUEST BOOK</h1>
<?php
    $guestbookFile = "../../data/guestbook.txt";

    if (is_readable($guestbookFile)) {
        echo "<pre>";
        readfile($guestbookFile);
        echo "</pre>";
    } else {
        echo "Cannot read the Guestbook.";
    }
?>
<p><a href="guestbookform.php">Guest Book Form</a></p>
</body>
</html>