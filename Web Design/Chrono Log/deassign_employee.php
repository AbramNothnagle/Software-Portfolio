<?php

    // Start a session
    session_start();
    // Check if they came from a proper submission
    if (isset($_POST['emp_id'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the employee id
        $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
        // Get the manager id
        $manager_id = $_SESSION['current_manager_id'];
        // Delete the assignment 
        $sql = "DELETE FROM assignment_managers WHERE emp_id = '$emp_id' AND manager_id = '$manager_id';";
        // Run the SQL
        mysqli_query($conn, $sql);
        // Send them back to the select_manager page to view a specific manager
        header("Location: ./select_manager.php");
        
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

