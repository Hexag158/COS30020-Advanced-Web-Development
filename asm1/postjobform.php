<!DOCTYPE html>
<html lang="en">
<head>
<title>Post Job Page - Job Vacancy Posting System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>Job Vacancy Posting System - Post Job Page</h1>
    <form action = "postjobprocess.php" method = "post" >
        <!-- Position Id -->
        <label for="position_id">Position ID:</label>
        <input type="text" id="position_id" name="position_id" maxlength="5" pattern="P\d{4}" >
        <br>
        <!-- Title -->
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" maxlength="20" pattern="[A-Za-z0-9\s,.!]{1,20}">
        <br>
        <!-- Description -->
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" maxlength="260"></textarea>      
        <br>
        <!-- Closing Date -->
        <label for="closing_date">Closing Date:</label>
        <input type="text" id="closing_date" name="closing_date" value="<?php echo date("d/m/y"); ?>">
        <br>
        <!-- Position -->
        <label for="position">Position:</label>
        <input type="radio" id="position_fulltime" name="position" value="Full Time" required>
        <label for="position_fulltime">Full Time</label>
        <input type="radio" id="position_parttime" name="position" value="Part Time" required>
        <label for="position_parttime">Part Time</label>        
        <br>
        <!-- Contract -->
        <label for="contract">Contract:</label>
        <input type="radio" id="contract_ongoing" name="contract" value="On-going" required>
        <label for="contract_ongoing">On-going</label>
        <input type="radio" id="contract_fixedterm" name="contract" value="Fixed term" required>
        <label for="contract_fixedterm">Fixed term</label>
        <br>
        <!-- Application by -->
        <label>Application by:</label>
        <input type="checkbox" id="accept_post" name="accept_box[]" value="Post">
        <label for="accept_post">Post</label>
        <input type="checkbox" id="accept_email" name="accept_box[]" value="Mail">
        <label for="accept_email">Mail</label>
        <br>
        <!-- Location -->
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
        <!-- Submit + Reset -->
        <input type="submit" name="submit" value="Post">
        <input type="reset" name="reset" value="Reset">
    </form>
    <br>
    <!-- Return Home Link -->
    <a href="index.php">Return to Home Page</a>
</body>
</html>
