<?php
    // Create the connection to the database
    include 'includes/dbh.inc.php';
    // Starts a session
    session_start();
    // Check to make sure it was submitted on page
    if(isset($_POST['project_delete'])) {
        // Get the chosen project's id
        $project_id = $_SESSION['project_id'];
        // Set the statas of that project to deleted
        $sql = "UPDATE projects SET status = 'deleted' WHERE project_id = '$project_id';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
        // Set a session variable 
        $_SESSION['just_deleted'] = 'true';
        // Delete all of the assignment from this project
        $sql2 = "DELETE FROM assignment_employees WHERE project_id = '$project_id';";
        // Run the SQL
        $result2 = mysqli_query($conn, $sql2); 
        // Delete all of the assignment from this project
        $sql3 = "DELETE FROM assignment_managers WHERE project_id = '$project_id';";
        // Run the SQL
        $result3 = mysqli_query($conn, $sql3); 
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

