<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Guestbook Form" />
<meta name="keywords" content="PHP, Guestbook" />
<meta name="Minh Nghia" content="103806269" />
<title>Guestbook Form</title>
</head>
<body>
<h1>Guestbook Form</h1>
<form action="guestbooksave.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required><br>

    <input type="submit" value="Submit">
</form>

<p><a href="guestbookshow.php">View Guest Book</a></p>
</body>
</html>
