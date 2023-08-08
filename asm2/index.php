<!DOCTYPE html>
<html lang="en">
<head>
<title>Home Page - My Friends System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>Home Page - My Friends System</h1>
    <p>Name: Nguyen Minh Nghia</br>
    Student ID: 103806269</br>
    Email: 103806269@student.swin.edu.au</p>

    <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I <br>
    copied fronm any other student's work or from any other source</p>

    <?php
        require_once ("settings.php");
        $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());

        if ($db_connect === false) {
            die("Connection to database failed: " . $db_connect->connect_error."<br>");
        }

        // Script create the 'friends' table if it does not exist
        $sql_create_friends_table = "CREATE TABLE IF NOT EXISTS friends (
            friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            friend_email VARCHAR(50) NOT NULL UNIQUE,
            f_password VARCHAR(20) NOT NULL,
            profile_name VARCHAR(30) NOT NULL,
            date_started DATE NOT NULL,
            num_of_friends INT UNSIGNED
        )";
        // Script create the 'myfriends' table if it does not exist
        $sql_create_myfriends_table = "CREATE TABLE IF NOT EXISTS myfriends (
            friend_id1 INTEGER NOT NULL,
            friend_id2 INTEGER NOT NULL,
            FOREIGN KEY (friend_id1) REFERENCES friends(friend_id) ON UPDATE CASCADE ON DELETE CASCADE,
            FOREIGN KEY (friend_id2) REFERENCES friends(friend_id) ON UPDATE CASCADE ON DELETE CASCADE,
            CHECK (friend_id1 <> friend_id2)
        )";

        // Create the 'friends' table
        if($db_connect->query($sql_create_friends_table) === TRUE) {
            echo "Script create Table 'friends' ran successfully<br>";
        } else {
            echo "Error creating table: " . $db_connect->error."<br>";
        }
        // Create the 'myfriends' table
        if($db_connect->query($sql_create_myfriends_table) === TRUE) {
            echo "Script create Table 'myfriends' ran successfully<br>";
        } else {
            echo "Error creating table: " . $db_connect->error."<br>";
        }

        // Script insert records into friends table
        $sql_insert_friends_table = "INSERT INTO friends (friend_email, f_password, profile_name, date_started, num_of_friends) VALUES
        ('ava3457@gmail.com', 'avak3457', 'Ava Kennoby', '2022-08-17', 4), 
        ('ethanm8723@gmail.com', 'ethan872', 'Ethan Moore', '2023-06-02', 3), 
        ('miamia2234@yahoo.com', 'miamia22', 'Mia Anderson', '2022-10-29', 3), 
        ('liamsmith7364@gmail.com', 'liam7364', 'Liam Smith', '2023-04-14', 3), 
        ('harperjane1876@gmail.com', 'harperja', 'Harper Jane', '2022-11-19', 3), 
        ('noahwilson5091@gmail.com', 'noah5091', 'Noah Wilson', '2022-12-30', 4), 
        ('charlottebrown7328@yahoo.com', 'charlott', 'Charlotte Brown', '2022-09-05', 4), 
        ('oliverjones2131@gmail.com', 'oliver21', 'Oliver Jones', '2023-03-21', 4), 
        ('ameliasmith6768@gmail.com', 'amelia67', 'Amelia Smith', '2022-11-11', 4), 
        ('jacksonbrown7387@gmail.com', 'jackson7', 'Jackson Brown', '2023-02-08', 4), 
        ('zacharymiller4429@gmail.com', 'zachary4', 'Zachary Miller', '2023-07-08', 4) 
        ";
        // Script insert records into myfriends table
        $sql_insert_myfriends_table = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES
        (3,10),(5,8),(2,7),(6,11),(1,10),(4,9),(7,11),(2,6),(8,11),(1,4),
        (9,10),(3,7),(5,6),(1,9),(4,8),(7,10),(2,11),(6,9),(1,5),(3,8)
        ";

        //Check if table are empty
        $sql_check_friends_table = "SELECT * FROM friends";
        $sql_check_myfriends_table = "SELECT * FROM myfriends";
        $result_friends = $db_connect->query($sql_check_friends_table);
        $result_myfriends = $db_connect->query($sql_check_myfriends_table);

        if (mysqli_num_rows($result_friends) == 0 || mysqli_num_rows($result_myfriends) == 0) {
            // Insert records into friends table
            if($db_connect->query($sql_insert_friends_table) === TRUE) {
                echo "Script insert records into Table 'friends' ran successfully<br>";
            } else {
                echo "Error inserting records into friends table: " . $db_connect->error."<br>";
            }

            // Insert records into myfriends table
            if($db_connect->query($sql_insert_myfriends_table) === TRUE) {
                echo "Script insert records into Table 'myfriends' ran successfully<br>";
            } else {
                echo "Error inserting records into myfriends table: " . $db_connect->error."<br>";
            }
        } else {
            echo "Table 'friends' and 'myfriends' are not empty<br>";
        }

        //close the connection
        $db_connect->close();
    ?>

    <p>
    <a href="signup.php">Sign Up</a><br>
    <a href="login.php">Log In</a><br>
    <a href="about.php">About Page</a>
    </p>
</body>
</html>