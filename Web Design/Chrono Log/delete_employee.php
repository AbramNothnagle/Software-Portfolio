<?php
    // Create the connection to the database
    include 'includes/dbh.inc.php';
    // Starts a session
    session_start();
    // Check to make sure it was submitted on page
    if(isset($_POST['employee_delete'])) {
        // Get the chosen project's id
        $emp_id = $_SESSION['current_emp_id'];
        // Set the statas of that project to deleted
        $sql = "UPDATE employees SET status = 'deleted' WHERE emp_id = '$emp_id';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
        // Set a session variable 
        $_SESSION['just_deleted_employee'] = 'true';
        // Delete all of the assignment from this project
        $sql2 = "DELETE FROM assignment_employees WHERE emp_id = '$emp_id_id';";
        // Run the SQL
        $result2 = mysqli_query($conn, $sql2); 
        // Delete all of the assignment from this project
        $sql3 = "DELETE FROM assignment_managers WHERE emp_id = '$emp_id_id';";
        // Run the SQL
        $result3 = mysqli_query($conn, $sql3);   
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }