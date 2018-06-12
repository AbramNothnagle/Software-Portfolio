<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['project'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the project id of the project being deassigned
        $project = mysqli_real_escape_string($conn, $_POST['project']);
        // Get the manager id
        $manager_id = $_SESSION['current_manager_id'];
        // Deassign that project from that manager
        $sql = "DELETE FROM assignment_managers WHERE project_id = '$project' AND manager_id = '$manager_id';";
        // Run the SQL
        mysqli_query($conn, $sql);
        // Send them back to the select_manager page to view a specific manager
        header("Location: ./select_manager.php");
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }


