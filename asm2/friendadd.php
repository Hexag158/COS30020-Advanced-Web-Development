<?php
    session_start();
    require ("settings.php");
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

    // Script to add new friend to friend list
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $add_friend_id = $_POST['friend_id'];
        $sql_add_friend = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ($session_friend_id, $add_friend_id)";
        $sql_update_num_of_friends1 = "UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = '$session_friend_id'";
        $sql_update_num_of_friends2 = "UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = '$add_friend_id'";

        $result_add_friend = mysqli_query($db_connect, $sql_add_friend);
        $result_update_num_of_friends1 = mysqli_query($db_connect, $sql_update_num_of_friends1);
        $result_update_num_of_friends2 = mysqli_query($db_connect, $sql_update_num_of_friends2);

        if ($result_add_friend){
            $message .= "<p>Friend added successfully!</p>";
            if($result_update_num_of_friends1 && $result_update_num_of_friends2){
                $message .= "<p>Friend number updated successfully!</p>";
            }
        }
        else {
            $message .= "<p>Friend addition failed!</p>";
    }}

    // Script to select the new friends' name from the database
    $sql_select_new_friend_name = "SELECT DISTINCT friends.friend_id,friends.profile_name
    FROM friends
    LEFT JOIN myfriends
    ON (myfriends.friend_id1 = friends.friend_id OR myfriends.friend_id2 = friends.friend_id)
    WHERE friends.friend_id != '$session_friend_id' AND ((myfriends.friend_id1 IS NULL AND myfriends.friend_id2 IS NULL) 
    OR (myfriends.friend_id1 != '$session_friend_id' AND myfriends.friend_id2 != '$session_friend_id'))
    AND friends.friend_id NOT IN (SELECT friend_id1 FROM myfriends WHERE friend_id2 = '$session_friend_id' 
    UNION SELECT friend_id2 FROM myfriends WHERE friend_id1 = '$session_friend_id')
    ORDER BY friends.friend_id ASC";

    $result_select_new_friend_name = mysqli_query($db_connect, $sql_select_new_friend_name);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Friend Page - My Friends System</title>
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
    // Check if user is logged in
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        // Get total number of friends
        $sql_get_num_of_friends = "SELECT num_of_friends FROM friends WHERE friend_email = '$session_email'";
        $result_get_num = mysqli_query($db_connect, $sql_get_num_of_friends);
        $row = mysqli_fetch_assoc($result_get_num);
        $totalFriends = $row['num_of_friends'];
        echo "<p>Welcome, " . $session_profile_name . "!</br>";
        echo "Total number of friends is ".$totalFriends."!</p>";

        // Check if there is any new friend
        if(mysqli_num_rows($result_select_new_friend_name) > 0){
            $results_per_page = 5;
            $total_pages = ceil(mysqli_num_rows($result_select_new_friend_name) / $results_per_page);
            if (!isset($_GET['page'])) {
                $current_page = 1;
            } else {
                $current_page = $_GET['page'];
            }
            $offset = ($current_page - 1) * $results_per_page;

            $sql_limit = " LIMIT $offset, $results_per_page";
            $result_select_new_friend_name_pagination = mysqli_query($db_connect, $sql_select_new_friend_name . $sql_limit);

            if(!$result_select_new_friend_name_pagination){
                die("Retrieval failed: ".mysqli_error($db_connect));
            }
            
            echo "<h2>People you may know</h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Friend ID</th>";
            echo "<th>Friend Name</th>";
            echo "<th>Mutual friends</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            while($row = mysqli_fetch_array($result_select_new_friend_name_pagination)){
                // Script to find mutual friends number
                $row_id = $row['friend_id'];
                $sql_get_mutual_friends = "SELECT DISTINCT friends.friend_id
                FROM friends
                JOIN myfriends
                ON (myfriends.friend_id1 = friends.friend_id OR myfriends.friend_id2 = friends.friend_id)           
                WHERE friends.friend_id IN
                (SELECT friends.friend_id
                FROM friends
                JOIN myfriends
                ON (myfriends.friend_id1 = friends.friend_id OR myfriends.friend_id2 = friends.friend_id)
                WHERE (myfriends.friend_id1 = '$session_friend_id' OR myfriends.friend_id2 = '$session_friend_id') AND friends.friend_id != '$session_friend_id')
                AND friends.friend_id IN 
                (SELECT friends.friend_id
                FROM friends
                JOIN myfriends
                ON (myfriends.friend_id1 = friends.friend_id OR myfriends.friend_id2 = friends.friend_id)
                WHERE (myfriends.friend_id1 = '$row_id' OR myfriends.friend_id2 = '$row_id') AND friends.friend_id != '$row_id')";
                $result_get_mutual_friends = mysqli_query($db_connect, $sql_get_mutual_friends);  
                $num_of_mutual_friends = mysqli_num_rows($result_get_mutual_friends);

                // Display new friends' name in table rows
                echo "<tr>";
                echo "<td>" . $row['friend_id'] . "</td>";
                echo "<td>" . $row['profile_name'] . "</td>";
                echo "<td>" . $num_of_mutual_friends . "</td>";
                echo "<td>";
                echo '<form action="friendadd.php" method="POST">';
                echo '<input type="hidden" name="friend_id" value="' . $row['friend_id'] . '">';
                echo '<input type="hidden" name="friend_profile_name" value="' . $row['profile_name'] . '">';
                echo '<button type="submit" name="addfriend" onclick="return confirm(\'Add this friend?\')"> Add friend</button>';
                echo '</form>';
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Pagination links
            echo "<div>";
            if ($current_page > 1) {
                echo '<a href="?page=' . ($current_page - 1) . '"> Previous </a>';
            }
            
            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a href="?page=' . $i . '">' . " ".$i." " . '</a>';
            }

            if ($current_page < $total_pages) {
                echo '<a href="?page=' . ($current_page + 1) . '"> Next </a>';
            }
            echo "</div>";

            mysqli_free_result($result_select_new_friend_name);
            $db_connect->close();
        } else{
        echo "<p>No new friends found</p>";
        }
    } else {
        header("location:login.php");
    }
    ?>

    <p><a href="friendlist.php">My Friend List</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</body>
</html>