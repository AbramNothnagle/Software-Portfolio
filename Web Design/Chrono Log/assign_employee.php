<?php

    // Start the session
    session_start();
    // Check if to make sure a proper submission was made
    if (isset($_POST['emp_id'])) {

        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the id of the employee being assigned
        $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
        // Get the manager's id that the employee is being assigned to
        $manager_id = $_SESSION['current_manager_id'];
        // Check to see if the employee is already assigned this manager
        $sql = "SELECT * FROM assignment_managers WHERE manager_id='$manager_id' AND emp_id='$emp_id';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Check the number of results
        $resultCheck = mysqli_num_rows($result); 
        // Check to see if there was no results
        if ($resultCheck == 0){
            // Assign the employee to the manager
            $sql = "INSERT INTO assignment_managers (emp_id, emp_email, manager_id) VALUES ('$emp_id','$manager_id');";
            // Run the SQL
            mysqli_query($conn, $sql);
        }
        // Send them back to select_manager page, the page to view a specific manager
        header("Location: ./select_manager.php");

    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

