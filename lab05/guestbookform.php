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
<h1>Web Programming Form - Lab 5 - TASK 2 - GUEST BOOK</h1>
<form action="guestbooksave.php" method="POST">
    <label for="first-name">First Name:</label>
    <input type="text" id="first-name" name="first-name" ><br>

    <label for="last-name">Last Name:</label>
    <input type="text" id="last-name" name="last-name" ><br>

    <input type="submit" value="Submit">
</form>
<p><a href="guestbookshow.php">Show Guest Book</a></p>
</form>
</body>
</html>