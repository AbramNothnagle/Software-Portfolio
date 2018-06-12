<?php
    
    // Only execute if the button named employee_added was pressed
    if(isset($_POST['employee_added'])) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Starts a session
        session_start();
        // Get the employee id being added
        $employee_id = $_POST['employee_id'];
        // Get the project id they are being assigned to
        $pid = $_SESSION['project_id'];
        // Get the project name they are being assigned to
        $project_name = $_SESSION['project_name'];
        // Check to see if they are already assigned to this project
        $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$employee_id' AND project_id = '$pid';";
        // Put the result into result
        $result = mysqli_query($conn, $sql);
        // Put how many results were found into resultCheck
        $resultCheck = mysqli_num_rows($result);
        // Add them if they were not already added
        if ($resultCheck < 1) {
            // Assign employee the project
            $sql = "INSERT INTO assignment_employees (emp_id, project_id, project_name) VALUES ('$employee_id', '$pid','$project_name');";
            // Execute sql
            $result = mysqli_query($conn, $sql);
        }
    }
