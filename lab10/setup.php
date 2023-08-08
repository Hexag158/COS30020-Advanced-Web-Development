<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $host = 'feenix-mariadb.swin.edu.au';
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $databasename = trim($_POST['databasename']);

    // Create the data directory and file
    $directoryPath = '../../data/lab10';
    $filePath = $directoryPath . '/mykeys.txt';

    chmod($filePath, 0777);
    // Create the data directory
    if (!is_dir($directoryPath)) {
        mkdir($directoryPath, 0777, true);
    }

    $fileHandle = fopen($filePath , "a");
    $detail = $host . "\n" . $username. "\n".$password."\n". $databasename."\n".PHP_EOL;
    fwrite($fileHandle, $detail);
    fclose($fileHandle);

    // Create the hitcounter table
    $conn = mysqli_connect($host, $username, $password, $databasename);

    if ($conn) {
        $createTableQuery = "CREATE IF NOT EXISTS TABLE hitcounter (
            id SMALLINT NOT NULL PRIMARY KEY,
            hits SMALLINT NOT NULL
        )";
        mysqli_query($conn, $createTableQuery);

        $insertDataQuery = "INSERT INTO hitcounter VALUES (1, 0)";
        mysqli_query($conn, $insertDataQuery);

        mysqli_close($conn);

        // Display success message
        echo "Setup completed successfully!";
    } else {
        echo "Failed to connect to the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Your Name" />
    <title>Set up</title>
</head>
<body>
    <h1>Web Programming - Lab10</h1>
    <form method="post" action="setup.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="databasename">Database Name:</label>
        <input type="text" name="databasename" required><br>

        <input type="submit" value="Set Up">
    </form>
</body>
</html>
