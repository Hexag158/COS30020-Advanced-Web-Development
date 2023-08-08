<!DOCTYPE html>
<html lang="en">
<head>
<title>Job Process Page - Job Vacancy Posting System</title>
<meta charset="utf-8">
<meta name="description" content="Web development">
<meta name="keywords" content="HTML, CSS, JavaScript">
<meta name="Nghia" content="103806269">
</head>
<body>
    <?php
        $job_directory = "../../data/jobposts";
        $job_file = "../../data/jobposts/jobs.txt";
        #created directory and file if not exist
        if (!file_exists($job_directory)) {
            mkdir($job_directory, 0777, true);
            echo "Directory created.";
        }
        if (!file_exists($job_file)) {
            $new_file = fopen($job_file, "w");
            if ($new_file) {
                fclose($new_file);
                echo "File created.";
            } else {
                echo "Error creating file.";
            }
        }
        
        #check is set for all field
        if(isset($_POST["position_id"]) && isset( $_POST["title"]) && isset($_POST["description"]) && isset($_POST["closing_date"]) && isset($_POST["position"]) && isset($_POST["contract"]) && isset($_POST['accept_box']) && isset($_POST["location"])){

            $position_id = $_POST["position_id"];
            $title = trim($_POST["title"]);
            $description = trim($_POST["description"]);
            $closing_date= $_POST["closing_date"];
            $position = $_POST["position"];
            $contract = $_POST["contract"];
            $location= $_POST["location"];
            $application_by = $_POST['accept_box'];

            #check valid positionID
            if(preg_match('/^P\d{4}$/',$position_id)){
                #check valid title
                if((preg_match('/^[a-zA-Z0-9 ,.!]{1,20}$/', $title)) && (!empty($title))){
                    #check valid description
                    if(!empty($description) && strlen($description) <= 260){
                        #check the closing date format
                        if(preg_match('/^\d{2}\/\d{2}\/\d{2}$/', $closing_date)){
                            $closing_date_Components = explode('/', $closing_date);
                            $check_day = intval($closing_date_Components[0]);
                            $check_month = intval($closing_date_Components[1]);
                            $check_year = intval($closing_date_Components[2]);
                            #check the valid date
                            if(count($closing_date_Components) == 3 && checkdate($check_month, $check_day, $check_year)){
                                #check position ID unique
                                $file_handle = fopen($job_file, "r") or die("Unable to open job.txt!");
                                $unique_id = true;
                                # Read each line from the file
                                while (($job_line = fgets($file_handle)) !== false) {
                                    # Position ID already exists
                                    // echo $job_line;
                                    if (strpos($job_line, $position_id) !== false) {
                                        $unique_id = false;
                                        break;
                                    }
                                }
                                fclose($file_handle);

                                if ($unique_id){
                                    #get value of checkbox
                                    $accept_Post = in_array('Post', $application_by)? 'Post' : '';
                                    $accept_Mail = in_array('Mail', $application_by)? 'Mail' : '';
                                    #create record line for saving
                                    $job_record = "$position_id\t$title\t$description\t$closing_date\t$position\t$contract\t$accept_Post\t$accept_Mail\t$location\n";
                                    #open save record and close file
                                    $job_handle = fopen($job_file, "a") or die("Unable to open job.txt!");
                                    fwrite($job_handle, $job_record);
                                    fclose($job_handle);
                                    echo '<span style="color: green"><p><b>Job Posted successfully!!</b></p></span>';
                                } else{
                                    echo '<span style="color: red"><p><b>Position ID already exists</b></p></span>';
                                }
                                
                            }else{
                                echo '<span style="color: red"><p><b>Invalid closing date input, please enter a real date.</b></p></span>';
                            }
                        }else{
                            echo '<span style="color: red"><p><b>Invalid closing date format (dd/mm/yy).</b></p></span>';
                        }
                    }else{
                        echo '<span style="color: red"><p><b>Job description is empty or too long</b></p></span>';
                    }
                }else{
                    echo '<span style="color: red"><p><b>Job title invalid, make sure no special symbols included</b></p></span>';
                }
            } else {
                echo '<span style="color: red"><p><b>Position ID invalid (e.g. P0001).</b></p></span>';
            }
        } else {
            echo '<span style="color: red"><p><b>Please fill in all the fields.</b></p></span>';
        }
    ?>
    <p><a href="index.php">Home Page</a></p>
    <p><a href="postjobform.php">Post another job</a></p>
</body>
</html>