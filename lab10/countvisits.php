<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="Nguyen Minh Nghia" content="103806269" />
<title>Lab 10 Task 1</title>
</head>
<body>
<h1>Web Programming - Lab10</h1>
    <?php
    require_once 'hitcounter.php';
    $filePath = '../../data/lab10/mykeys.txt';

    $fileHandle = fopen($filePath, "r"); 
    $data = fread($fileHandle, filesize($filePath)); 

    fclose($fileHandle); 

    $lines = explode("\n", $data);

    $host = isset($lines[0]) ? $lines[0] : '';
    $user = isset($lines[1]) ? $lines[1] : '';
    $pswd = isset($lines[2]) ? $lines[2] : '';
    $dbnm= isset($lines[3]) ? $lines[3] : '';
    $tablename = 'hitcounter';

    // Instantiate the HitCounter object
    $Counter = new HitCounter($host, $user, $pswd, $dbnm, $tablename);

    // Display the current hits
    echo 'The old hits: ';
    $Counter->getHits();

    // Increment the hits by one
    $Counter->setHits();

    echo 'The new hits: ';
    $Counter->getHits();

    // Close the database connection
    $Counter->closeConnection();
    ?>
    <p><a href="startover.php">Start Over</a></p>
</body>
</html>

