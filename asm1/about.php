<!DOCTYPE html>
<html lang="en">
<head>
<title>About Page - Job Vacancy Posting System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>About Page</h1>
    <ul>
        <li><b> What is the PHP version installed in mercury? </b><?php echo phpversion();?></b> </li>
        <li><b>What tasks you have not attempted or not completed?</b><br>
            =>The only tasks that i have not attempted is adding CSS used for colours and styles </li>
        <li><b>What special features have you done, or attempted, in creating the site that we should know about? </b><br>
            => I have completed the post job function as well as the validate function for each fields. The search<br>
            page can search the job with the keyword and also search with the filters. The search result only <br>
            display the result with closing date later than the current date and especially it will display the<br>
            job with descending order. The sorting was using bubble sort algorithm</b>
        </li>
        <li><b>What discussion points did you participated on in the units discussion board for Assignment 1? </b><br>
            => I joined the discussion about Css and validation method on canvas. I did not use the discuss usually<br>
            because i wanna try to solve the problem myself, beside it, when i can not, i can still find to solution <br>
            with just one click on google. Here is the screenshots: <br><br>
            <?php echo "<img src='screenshot.jpg' width=800' >"; ?> </li>
    </ul>
    
    <p><a href="index.php">Return to Home</a><p>
</body>
</html>