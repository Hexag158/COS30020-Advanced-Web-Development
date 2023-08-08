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

    // Select member_id, fname, lname from 'vipmembers' table
    $sqlSelect = "SELECT member_id, fname, lname FROM vipmembers";
    $result = $db_connect->query($sqlSelect);

    // Display the records in an HTML table
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Member ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["member_id"] . "</td>
                    <td>" . $row["fname"] . "</td>
                    <td>" . $row["lname"] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No members found";
    }

    $db_connect->close();
    ?>
</body>
</html>