<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Guestbook Form" />
<meta name="keywords" content="PHP, Guestbook" />
<meta name="Minh Nghia" content="103806269" />
<title>Guestbook save</title>
</head>
<body>
<h1>Guestbook Form</h1>
<?php
// File path
$file = '../../data/lab06/guestbook.txt';

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted name and email
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Validate name and email
    if (!empty($name) && !empty($email)) {
        // Check if the name or email already exists in the guestbook
        $entries = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        $existingEntry = false;
        foreach ($entries as $entry) {
            list($existingName, $existingEmail) = explode(',', $entry);
            if ($name === $existingName || $email === $existingEmail) {
                $existingEntry = true;
                break;
            }
        }

        if ($existingEntry) {
            echo 'Name or email address already exists in the guestbook.';
        } else {
            // Append the name and email to the guestbook file
            $data = $name . ',' . $email . PHP_EOL;
            file_put_contents($file, $data, FILE_APPEND);
            echo 'Guestbook entry saved successfully.';
        }
    } else {
        echo 'Please enter both name and email address.';
    }
} else {
    echo 'Invalid request method.';
}
?>
<p><a href="guestbookshow.php">View Guest Book</a></p>
</body>
</html>