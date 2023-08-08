<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Result - Job Vacancy Posting System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <h1>Job Vacancy Search Results</h1>
    <?php 
        echo "<h2>Search result for: " .$_GET["job_title"]."</h2>";
    ?>
    <?php
        # Txt file path
        $job_file = "../../data/jobposts/jobs.txt";
        if(isset($_GET["job_title"]) && !empty($_GET["job_title"])){

            $job_title = $_GET["job_title"];
            # Get filters value
            $position_filter = isset($_GET["position"]) ? $_GET["position"] : "";
            $contract_filter = isset($_GET["contract"]) ? $_GET["contract"] : ""; 
            $application_by_filter = isset($_GET['accept_box']) ? $_GET['accept_box'] : []; 
            $location_filter = isset($_GET["location"]) ? $_GET["location"]  : "";

            $accept_post_filter = in_array('Post', $application_by_filter)? 'Post' : '';
            $accept_mail_filter = in_array('Mail', $application_by_filter)? 'Mail' : '';

            # Open file for rading
            $job_lines = file($job_file,FILE_IGNORE_NEW_LINES);
            $job_matched = array();

            # Check matching job title
            foreach ($job_lines as $job_line){

                $flds = explode("\t", $job_line);

                $close_date = DateTime::createFromFormat("d/m/y", $flds[3]);
                $current_date = new DateTime();

                # Get all checked criterias
                $position_checked = ($position_filter == '' || stripos($job_line, $position_filter) != false);
                $contract_checked  = ($contract_filter == '' || stripos($job_line, $contract_filter) != false);
                $application_post_checked  = ($accept_post_filter == '' || stripos($job_line, $accept_post_filter) != false);
                $application_mail_checked  = ($accept_mail_filter == '' || stripos($job_line, $accept_mail_filter) != false);
                $location_checked  = ($location_filter == '' || stripos($job_line, $location_filter) != false);

                # Check if the job matched all the criterias
                if(stripos($job_line,$job_title) !=false && $position_checked && $contract_checked && $application_post_checked && $application_mail_checked && $location_checked){
                    if($current_date <= $close_date){
                        $job_matched[] = $job_line;
                    }
                }
            }

            # Sort the closing day
            $job_count = count($job_matched);
            for ($i = 0; $i < $job_count - 1; $i++) {
                for ($j = 0; $j < $job_count - $i - 1; $j++) {
                    $job1_closing_day = explode("\t", $job_matched[$j]);
                    $job2_closing_day = explode("\t", $job_matched[$j + 1]);
                    # Get the closing date
                    $closing_day1 = DateTime::createFromFormat("d/m/y", $job1_closing_day[3]); 
                    $closing_day2 = DateTime::createFromFormat("d/m/y", $job2_closing_day[3]);

                    if ($closing_day1 > $closing_day2) {
                        # Swap the positions of 2 jobs
                        $temp = $job_matched[$j];
                        $job_matched[$j] = $job_matched[$j + 1];
                        $job_matched[$j + 1] = $temp;
                    }
                }
            }

            # Print jobs out
            if(!empty($job_matched)){
                foreach ($job_matched as $jb_match){
                    # Get all the field from job matched array
                    $flds = explode("\t", $jb_match);
                    $job_tit = $flds[1];
                    $description = $flds[2];
                    $closing_date = $flds[3];
                    $position = $flds[4];
                    $contract = $flds[5];
                    $accept_post = $flds[6];
                    $accept_mail= $flds[7];
                    $location = $flds[8];

                    # Print all matched jobs to the page
                    echo "Job Title: $job_tit<br>";
                    echo "Description: $description<br>";
                    echo "Closing Date: $closing_date<br>";
                    echo "Position: ".$position." - ".$contract."<br>";
                    echo "Application by: ";
                    # Check if the application have 2 or 1 accept method
                    if(!empty ($accept_post)){
                        if(!empty ($accept_mail)){
                            echo " $accept_post or $accept_mail <br>";
                        } else{
                            echo " $accept_post<br>";
                        }
                    } else{
                        echo " $accept_mail <br>";
                    }
                    echo "Location: $location<br>"; 
                    echo '<p><a href="index.php">Back to Home Page</a>'.' | ';
                    echo '<a href="searchjobform.php">Search For Job again</a></p>';
                }
            }else{
                echo '<span style="color: red"><p><b>No job found for '.$job_title.'</b></p></span>';
                echo '<p><a href="index.php">Back to Home Page</a>'.' | ';
                echo '<a href="searchjobform.php">Search For Job again</a></p>';
            }

        } else {
            echo '<span style="color: red"><p><b>Please fill in the job title to search</b></p></span>';
            echo '<p><a href="index.php">Back to Home Page</a>'.' | ';
            echo '<a href="searchjobform.php">Search For Job again</a></p>';
        }
    ?>
</body>
</html>