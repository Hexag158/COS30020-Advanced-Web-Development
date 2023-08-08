<?php
    session_start();
    require_once ("settings.php");
    $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());

    if ($db_connect ===false ) {
        die("Connection to database failed: " . $db_connect->connect_error."<br>");
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Check if the fields are set
    if (isset($_POST['email']) & isset($_POST['profile_name']) & isset($_POST['password']) & isset($_POST['confirm_password'])) {
        $email = $_POST['email'];
        $profile_name = $_POST['profile_name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors_list = [];

        // Check if email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors_list[] = "Invalid email address format";
        }

        //Check if profile name is valid
        if (!preg_match("/^[a-zA-Z ]+$/", $profile_name) || empty($profile_name)) {
            $errors_list[] = "Profile name must contain only letters and cannot be blank";
        }

        // Check if password and confirm password match
        if (!preg_match("/^[a-zA-Z0-9]+$/", $password) || $password != $confirm_password) {
            $errors_list[] = "Password and confirm password do not match (Password must contain only letters and number.";
        
        } 

        // Check if email already exists
        $sql_select_email = "SELECT * FROM friends WHERE friend_email = '$email'";
        $result = mysqli_query($db_connect, $sql_select_email);

        if (!$result) {
            // Handle query error
            $errors_list[] = "Error executing the query: " . mysqli_error($db_connect);
        } else {
            // Query executed successfully
            if (mysqli_num_rows($result) > 0) {
                $errors_list[] = "Email address already exists.";
            }
        }
        
        // If no errors, insert new user into database
        if (empty($errors_list)){
            $_SESSION['email'] = $email;
            $sql_insert_new_user = "INSERT INTO friends (friend_email, profile_name, f_password, date_started, num_of_friends) VALUES ('$email', '$profile_name', '$password', CURDATE(), 0)";
            // Execute the query
            if (mysqli_query($db_connect, $sql_insert_new_user)) {
                echo "<p>Registration successful.</p>";
                $_SESSION['logged_in'] = true;
                
                mysqli_close($db_connect);
                header("location:friendadd.php");
            } else {
                $errors_list[]= "Error: mysqli_error" . $db_connect->error."<br>";
            }
        }

            mysqli_close($db_connect);
    } else {
        $errors_list[] = "All fields must be filled in.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign Up Page - My Friends System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>My Friends System<br>Registration Page</h1>

    <p><?php
        if (!empty($errors_list)): 
            foreach ($errors_list as $error): 
                echo $error;
            endforeach;
        endif;
    ?></p>

    <form method="post" action="signup.php" >
        <label>Email address:</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email:''; ?>" required><br>

        <label>Profile name:</label>
        <input type="text" name="profile_name" value="<?php echo isset($profile_name) ? $profile_name:''; ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm password:</label>
        <input type="password" name="confirm_password" required><br>

        <input type="submit" value="Register">
        <input type="reset" value="Clear">
    </form>

    <p><a href="index.php">Return to Home page</a></p>
    <p>Already have an account? <a href="login.php">Log In</a>.</p>
    </body>
</html>