<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Job Page - Job Vacancy Posting System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>Job Vacancy Posting System - Search Job Page</h1>
    <form action="searchjobprocess.php" method="GET">
        <!-- search job title -->
        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title">
        <!-- extra criteria or filter -->
        <h3>Extra Criteria:</h3>
        <!-- search by position -->
        <label for="position">Position:</label>
        <input type="radio" id="position_fulltime" name="position" value="Full Time" >
        <label for="position_fulltime">Full Time</label>
        <input type="radio" id="position_parttime" name="position" value="Part Time" >
        <label for="position_parttime">Part Time</label>        
        <br>
        <!-- search by contract -->
        <label for="contract">Contract:</label>
        <input type="radio" id="contract_ongoing" name="contract" value="On-going" >
        <label for="contract_ongoing">On-going</label>
        <input type="radio" id="contract_fixedterm" name="contract" value="Fixed term" >
        <label for="contract_fixedterm">Fixed term</label>
        <br>
        <!-- search by accept application  -->
        <label>Application by:</label>
        <input type="checkbox" id="accept_post" name="accept_box[]" value="Post">
        <label for="accept_post">Post</label>
        <input type="checkbox" id="accept_email" name="accept_box[]" value="Mail">
        <label for="accept_email">Mail</label>
        <br>
        <!-- search by location -->
        <label for="location">Location:</label>
        <select id="location" name="location">
            <option value="">---</option>
            <option value="ACT">ACT</option>
            <option value="NSW">NSW</option>
            <option value="NT">NT</option>
            <option value="QLD">QLD</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="VIC">VIC</option>
            <option value="WA">WA</option>
        </select>
        <br><br>

        
        <button type="submit">Search</button>
    </form>
    <p><a href="index.php">Return to Home</a><p>
</body>
</html>