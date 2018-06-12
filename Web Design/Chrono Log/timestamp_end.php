<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['timestamp'])) {
        // Create a database connection
        include 'includes/dbh.inc.php';
        // Get the employee's id
        $eid = $_SESSION['e_id'];
        // Get the time of the end. It will be a unix time
        $timestamp = $_POST['timestamp'];
        // Get the length of the entry
        $time = $_POST['time'];
        // Update the the end time of the entry
        $sql = "UPDATE timeGeneral SET time_end='$timestamp' WHERE submitted='no' AND emp_id = '$eid';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
        // Update the length of the entry
        $sql = "UPDATE timeGeneral SET time='$time' WHERE submitted='no' AND emp_id = '$eid';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
        // Update the submitted status to yes as they are finished with this entry
        $sql = "UPDATE timeGeneral SET submitted='yes' WHERE submitted='no' AND emp_id = '$eid';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }