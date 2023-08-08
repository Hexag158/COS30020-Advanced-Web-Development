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
    <h1>Web Programming - Lab08</h1>
    <?php
        require_once ("settings.php");
        // complete your answer based on Lecture 8 slides 26 and 44
        // Connect to the database
        $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());
    

        // Select car_id, make, model, and price from the cars table
        $query = "SELECT car_id, make, model, price FROM cars";
        $result = mysqli_query($db_connect, $query);

        // Display the results in an HTML table
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['car_id'] . "</td>";
                echo "<td>" . $row['make'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No cars found in the database.";
        }

        // Close the database connection
        mysqli_close($db_connect);
        ?>
</body>
</html>