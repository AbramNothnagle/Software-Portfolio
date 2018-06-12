<?php

    // Start a session
    session_start();
    // Connect to database
    include 'includes/dbh.inc.php';
    // Get the chosen employee
    $emp_id = $_POST['emp_id'];
    // Get the currect project id
    $project_id = $_SESSION['project_id'];
    // Get the current project name
    $project_name = $_SESSION['project_name'];
    // Find entry if the employee has been assigned to this project 
    $sql = "SELECT * FROM assignment_employees WHERE emp_id ='$emp_id' AND project_id='$project_id';";
    // Put result into $result
    $result = mysqli_query($conn, $sql);
    // Get number of results 
    $resultCheck = mysqli_num_rows($result);
    // If there were no results enter into database
    if( $resultCheck == 0 ) {
        // Assign employee the project
        $sql = "INSERT INTO assignment_employees (emp_id, project_id, project_name) VALUES ('$emp_id', '$project_id','$project_name');";
        // Execute sql
        $result = mysqli_query($conn, $sql);
    }
