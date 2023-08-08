<?php
    session_start();
    require_once ("settings.php");
    $db_connect = mysqli_connect($host, $user, $pswd, $dbnm) or die("Connection failed: " . mysqli_connect_error());

    if ($db_connect ===false ) {
        die("Connection to database failed: " . $db_connect->connect_error."<br>");
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['email'])&&isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $errors_list = [];

        // Check if email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors_list[] .= "Invalid email address format";
        }

        // Check if password is valid
        if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
            $errors_list[] .= "Password must contain only lowercase letters and numbers.";
        } 

        // Check if email exists
        $sql_select_email = "SELECT * FROM friends WHERE friend_email = '$email'";
        $result = mysqli_query($db_connect, $sql_select_email);

        if (mysqli_num_rows($result) == 0) {
            $errors_list[] .="Email address does not exist.";
        } 

        // Check if password is correct
        $sql_select_password = "SELECT * FROM friends WHERE friend_email = '$email' AND f_password = '$password'";
        $result = mysqli_query($db_connect, $sql_select_password);

        if (mysqli_num_rows($result) == 0) {
            $errors_list[] .="Password is incorrect.";
        } 

        // If no errors, log in
        if (empty($errors_list)){
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;
            
            header("location:friendlist.php");
        }
            mysqli_close($db_connect);
    }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Log In Page - My Friends System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>My Friends System<br>Log In Page</h1>

    <?php
        if (!empty($errors_list)) : 
            foreach ($errors_list as $error) : 
                echo "<p>".$error."</p>";
            endforeach;
        endif;
    ?>

    <form method="post" action="login.php" >
        <label>Email address:</label>
        <input type="email" name="email" value= "<?php echo isset($email) ? $email : ''; ?>" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Log In">
        <input type="reset" value="Clear">
    </form>            
    <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
    <p><a href="index.php">Return to Home page</a></p>
</body>
</html>