<?php
    // Start a session
    session_start();
    // Check to make sure there was a proper submission
    if (isset($_POST['timestamp'])) {
        // Create a database connection
        include 'includes/dbh.inc.php';
        // Set the submitted status to breakdone. This means the break is over
        $sumbitted = "breakdone";
        // Get the employee's id
        $eid = $_SESSION['e_id'];
        // Get the time the break ended. This will be a unix time
        $timestamp = $_POST['timestamp'];
        // Find the entry that isn't submitted that this entry is for
        $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$eid';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the time id
            $time_id= $row['time_id'];
        }
        // Update the break's end time
        $sql = "UPDATE timeGeneral SET breakend='$timestamp' WHERE submitted='break' AND emp_id = '$eid';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
        // Set the break to done
        $sql = "UPDATE timeGeneral SET submitted='breakdone' WHERE submitted='break' AND emp_id = '$eid';";
        // Run the SQL
        $result = mysqli_query($conn, $sql); 
    } else {
        // Send them back to home page
        header("Location: ./index.php");           
    }