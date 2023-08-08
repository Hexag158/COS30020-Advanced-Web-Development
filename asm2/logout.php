<!DOCTYPE html>
<html lang="en">
<head>
<title>Logout- My Friends System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
<?php
// Start the session
session_start();

// Clear all session variables
session_unset();
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page
header('Location: index.php');
exit;
?>
</body>
</html>