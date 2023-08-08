<?php session_start();?>
<?php 
    // Connect to the database
    require_once ("settings.php");
    $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());

    if ($db_connect ===false ) {
        die("Connection to database failed: " . $db_connect->connect_error."<br>");
    }
    
    $session_email = $_SESSION['email'];
    $message = "";

    // Script to get friend id and profile name
    $sql_get_id = "SELECT friend_id, profile_name FROM friends WHERE friend_email = '$session_email'";
    $session_friend_id = mysqli_query($db_connect, $sql_get_id);
    $row = mysqli_fetch_assoc($session_friend_id);
    $session_friend_id = $row['friend_id'];
    $session_profile_name = $row['profile_name'];

    // Script to delete friends
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $delete_friend_id = $_POST['friend_id'];
        $sql_delete_friend = "DELETE FROM myfriends WHERE friend_id1 = '$delete_friend_id' OR friend_id2 = '$delete_friend_id'";
        $sql_update_num_of_friends1 = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = '$session_friend_id'";
        $sql_update_num_of_friends2 = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = '$delete_friend_id'";

        $result_delete_friend = mysqli_query($db_connect, $sql_delete_friend);
        $result_update_num_of_friends1 = mysqli_query($db_connect, $sql_update_num_of_friends1);
        $result_update_num_of_friends2 = mysqli_query($db_connect, $sql_update_num_of_friends2);

        if ($result_delete_friend && $result_update_num_of_friends1 && $result_update_num_of_friends2){
            $message .= "<p>Friend deleted successfully!</p>";
        }
        else {
            $message .= "<p>Friend deletion failed!</p>";
        }
    }

    // Script to select the friends' name from the database
    $sql_get_myfriends_name = "SELECT friends.friend_id,friends.profile_name
    FROM friends
    INNER JOIN myfriends
    ON (myfriends.friend_id1 = friends.friend_id OR myfriends.friend_id2 = friends.friend_id)
    WHERE (myfriends.friend_id1 = '$session_friend_id' OR myfriends.friend_id2 = '$session_friend_id') AND friends.friend_id != '$session_friend_id' ";
    
    $result_select_friends = mysqli_query($db_connect, $sql_get_myfriends_name);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>List Friend Page - My Friends System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>My Friends System</h1>

    <?php 
        // print out if there is any message
        if(!empty ($message))
        {
            echo $message;
            $message = "";
        }
        ?>
    <?php   
        // Check if the user is logged in
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            $sql_get_num_of_friends = "SELECT num_of_friends FROM friends WHERE friend_email = '$session_email'";
            $result_get_num = mysqli_query($db_connect, $sql_get_num_of_friends);
            $row = mysqli_fetch_assoc($result_get_num);
            $totalFriends = $row['num_of_friends'];
            echo "<p>Welcome, " . $session_profile_name . "!</br>";
            echo "Total number of friends is ".$totalFriends."!</p>";

            // Display friends' name in table 
            if(mysqli_num_rows($result_select_friends) > 0){
                echo "<table>";
                echo "<tr>";
                echo "<th>Friend ID</th>";
                echo "<th>Friend Name</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                while($row = mysqli_fetch_array($result_select_friends)){
                    echo "<tr>";
                    echo "<td>" . $row['friend_id'] . "</td>";
                    echo "<td>" . $row['profile_name'] . "</td>";
                    echo "<td>";
                    echo '<form action="friendlist.php" method="POST">';
                    echo '<input type="hidden" name="friend_id" value="' . $row['friend_id'] . '">';
                    echo '<input type="hidden" name="friend_profile_name" value="' . $row['profile_name'] . '">';
                    echo '<button type="submit" name="unfriend" onclick="return confirm(\'Remove this friend?\')">Unfriend</button>';
                    echo '</form>';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result_select_friends);
                $db_connect->close();
            } else{
                echo "<p>You have no friends, sorry about that:(</p>";
            }
        } else {
            header("location:login.php");
        }
    ?>

    <p><a href="friendadd.php">Add a friend</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>