<?php
    require_once ("settings.php");
    $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());

    // Search for members based on last name
    if (isset($_POST["search_lastname"])) {
        $searchLastName = $_POST["search_lastname"];

        // Select member_id, fname, lname, email from 'vipmembers' table based on last name
        $sqlSearch = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$searchLastName%'";
        $result = $db_connect->query($sqlSearch);

        // Display the search results in an HTML table
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Member ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>";
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["member_id"] . "</td>
                        <td>" . $row["fname"] . "</td>
                        <td>" . $row["lname"] . "</td>
                        <td>" . $row["email"] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No members found";
        }
}
?>

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
    <h2>Search Members</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="search_lastname">Last Name:</label>
        <input type="text" id="search_lastname" name="search_lastname" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>