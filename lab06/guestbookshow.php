<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Guestbook Form" />
<meta name="keywords" content="PHP, Guestbook" />
<meta name="Minh Nghia" content="103806269" />
<title>Guestbook Show</title>
</head>
<body>
<h1>Guestbook Show</h1>
<?php
// File path
$file = '../../data/lab06/guestbook.txt';

// Read guestbook entries into an array
$entries = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Sort the entries by name
sort($entries);

// HTML table to display the guestbook entries
echo '<table>';
echo '<tr><th>Name</th><th>Email</th></tr>';

foreach ($entries as $entry) {
    list($name, $email) = explode(',', $entry);
    echo "<tr><td>$name</td><td>$email</td></tr>";
}

echo '</table>';


<p><a href="guestbookshow.php">View Guest Book</a></p>
</body>
</html>