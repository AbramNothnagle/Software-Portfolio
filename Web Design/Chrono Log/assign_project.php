<?php
    
    // Start a session
    session_start();
    // Check to see that a project_id was sent, and a proper submission was made
    if (isset($_POST['project_id'])) {
        
        // Connect to database 
        include 'includes/dbh.inc.php';
        // Get the sent project id
        $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);
        // Get the current manager that is being viewed
        $manager_id = $_SESSION['current_manager_id'];
        // Check if the manager was already assigned that project
        $sql = "SELECT * FROM assignment_managers WHERE manager_id='$manager_id' AND project_id='$project_id';";
        // Put the result into result
        $result = mysqli_query($conn, $sql);
        // Get the number of results
        $resultCheck = mysqli_num_rows($result);  
        // If more than 0 results, they were already assigned
        if ($resultCheck == 0) {
            // Assign the managers to that project since 0 results happened
            $sql = "INSERT INTO assignment_managers (project_id, manager_id) VALUES ('$project_id','$manager_id');";
            // Run the sql
            mysqli_query($conn, $sql);
        }
        // Send them back to select_manager page, the page to view a specific manager
        header("Location: ./select_manager.php");
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

