<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_POST['timestamp'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Start submitted to now because they haven't clocked out yet
        $sumbitted = "no";
        // Get the employee's id
        $eid = $_SESSION['e_id'];
        // Get the employee's company id
        $emp_org_id = $_SESSION['e_org_id'];  
        // Get the time of the start. It will be a unix time
        $timestamp = $_POST['timestamp'];
        // Get the project it is clocked for
        $project_id = $_POST['current_project'];
        // Get the job code
        $job_code = $_POST['job_code'];
        // Get the company id 
        $org_id = $_SESSION['e_org_id'];
        // Check if a job code was entered
        if ($job_code != 'none') {
            // Get the projects with this entries project id and has the user's org id
            $sql = "SELECT * FROM projects WHERE job_code = '$job_code' AND org_id = '$org_id';";
            // Put the result into $result2
            $result2 = mysqli_query($conn, $sql);
            // Go through each result
            while ($row2 = $result2->fetch_assoc()) {
                // Get the project's name
                $project_id = $row2['project_id'];
            }
        } 
        // Get the currect date. It will be in YYYY-MM-DD format
        $date = date("Y-m-d");
        // Put the timestamp into the database
        $sql = "INSERT INTO timeGeneral (date, project_id, time_start, submitted, emp_id, emp_org_id, status) VALUES ('$date','$project_id','$timestamp','$sumbitted','$eid','$emp_org_id','active');";
        // Run the SQL
        mysqli_query($conn, $sql);   
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }


