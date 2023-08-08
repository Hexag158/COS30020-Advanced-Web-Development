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

// Reset the hits to zero
$Counter->startOver();

// Close the database connection
$Counter->closeConnection();


header("location: countvisits.php");
?>
