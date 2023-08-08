<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="Nguyen Minh Nghia" content="103806269" />
<title>WEEK 6 - LAB 6 - Shopping save</title>
</head>
<body>
<h1>Web Programming Form - Lab06</h1>
<form action="shoppingsave.php" method="POST">
    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" name="item_name" required><br><br>
    
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required><br><br>
    
    <input type="submit" value="Submit">
</form>
</body>
</html>
