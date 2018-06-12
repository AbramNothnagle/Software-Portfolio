<?php
   
    // Starts a session
    session_start();
    // Checks to make sure there was a proper submission
    if(isset($_POST['project_save'])) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Gets the admin's id that submitted the project
        $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
        // Gets the submitted date
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        // Gets the submitted project name 
        $projectName = mysqli_real_escape_string($conn, $_POST['project_name']);
        // Gets the company id that the project belongs to
        $org_id = mysqli_real_escape_string($conn, $_SESSION['u_org_id']);
        // Gets the submitted description of the project
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        //Get the submitted job code
        $job_code = mysqli_real_escape_string($conn, $_POST['job_code']);
        // Makes sure that the project name is not empty
        if ($projectName != null) {
            // Put the project in the database
            $sql = "INSERT INTO projects (uid, date, project_name, org_id, description, status, job_code) VALUES ('$uid','$date','$projectName','$org_id','$description','active','$job_code')";
            // Run the SQL
            $result = mysqli_query($conn, $sql);
            // Get the last inserted id
            $last_insert_id = $conn->insert_id;
            // Send back the inserted id
            echo $last_insert_id;
            
        }
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }
