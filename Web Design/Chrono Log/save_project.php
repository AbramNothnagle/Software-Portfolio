<?php
   

    // Starts a session
    session_start();
    // Checks to make sure there was a proper submission
    if(isset($_POST['project_submit'])) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Gets the admin's id that submitted the project
        $uid = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        // Gets the submitted date
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        // Gets the submitted project name 
        $projectName = mysqli_real_escape_string($conn, $_POST['projectName']);
        // Gets the sumbmitted hours
        $hours = mysqli_real_escape_string($conn, $_POST['hours']);
        // Gets the company id that the project belongs to
        $org_id = mysqli_real_escape_string($conn, $_SESSION['u_org_id']);
        // Gets the submitted description of the project
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        //Get the submitted job code
        $job_code = mysqli_real_escape_string($conn, $_POST['job_code']);
        // Makes sure that the project name is not empty
        if ($projectName != null) {
            // Put the project in the database
            $sql = "INSERT INTO projects (uid, hours, date, project_name, org_id, description, status, job_code) VALUES ('$uid','$hours','$date','$projectName','$org_id','$description','active','$job_code')";
            // Run the SQL
            $result = mysqli_query($conn, $sql);
        }
        // Send them to the last page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }
