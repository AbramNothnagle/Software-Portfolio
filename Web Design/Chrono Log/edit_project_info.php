<?php 
    // Start a session
    session_start();
    // Check to make sure there was a proper submission 
    if(isset($_POST['project_edit'])){
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Get the description that was given
        $description = $_POST['description'];
        // Get the new project name that was given
        $new_project_name = $_POST['project_name'];
        // Get the project id of the project being edited
        $pid = $_POST['project_id'];
        // Get the new date of the project
        $new_date = $_POST['date'];
        // Get the new job code
        $new_job_code = $_POST['job_code'];
        // Check if the project name is not null
        if ($new_project_name != null) {
            // Update the project name
            $result = mysqli_query($conn, "UPDATE projects SET project_name='$new_project_name' WHERE project_id = '$pid'");
        }
        // Update the date
        $result2 = mysqli_query($conn, "UPDATE projects SET date='$new_date' WHERE project_id = '$pid'");   
        // Update the descriptions
        $result3 = mysqli_query($conn, "UPDATE projects SET description='$description' WHERE project_id = '$pid'");    
        // Update the job_code
        $result3 = mysqli_query($conn, "UPDATE projects SET job_code='$new_job_code' WHERE project_id = '$pid'");   
        
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }