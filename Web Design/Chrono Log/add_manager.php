<?php
    
    // Only execute if the button named manager_added was pressed
    if(isset($_POST['manager_added'])) {
        // Create the connection to the database
        include 'includes/dbh.inc.php';
        // Starts a session
        session_start();
        // Get the manager id being added
        $manager_id = $_POST['manager_id'];
        // Get the project id they are being assigned to
        $pid = $_SESSION['project_id'];
        // Get the project name they are being assigned to
        $project_name = $_SESSION['project_name'];
        // Check to see if they are already assigned to this project
        $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
        // Put the result into result
        $result = mysqli_query($conn, $sql);
        // Put how many results were found into resultCheck
        $resultCheck = mysqli_num_rows($result);
        // Add them if they were not already added
        if ($resultCheck < 1) {
            // Add the manager to the project
            $sql = "INSERT INTO assignment_managers (manager_id, project_id, project_name) VALUES ('$manager_id', '$pid','$project_name');";
            // Run the SQL
            $result = mysqli_query($conn, $sql);
        }
    }
