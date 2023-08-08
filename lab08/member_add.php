<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="Nguyen Minh Nghia" content="103806269" />
<title>Lab 08</title>
</head>
<body>
    <?php
    require_once ("settings.php");
    $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());

    // Create the 'vipmembers' table if it does not exist
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS vipmembers (
        member_id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(40),
        lname VARCHAR(40),
        gender VARCHAR(1),
        email VARCHAR(40),
        phone VARCHAR(20)
    )";

    if ($db_connect->query($sqlCreateTable) === TRUE) {
        echo "Script create Table 'vipmembers' ran successfully<br>";
    } else {
        echo "Error creating table: " . $db_connect->error;
    }

    // Insert the details from the 'Add New Member Form' into the 'vipmembers' table
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sqlInsert = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";

    if ($db_connect->query($sqlInsert) === TRUE) {
        echo "New member added successfully";
    } else {
        echo "Error inserting member: " .$db_connect-->error;
    }

    // Close the database connection
    $db_connect->close();
    ?>
</body>
</html>