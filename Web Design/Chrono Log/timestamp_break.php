<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_POST['timestamp'])) {
        // Create a database connection
        include 'includes/dbh.inc.php';
        // Set the submitted status as a break
        $sumbitted = "break";
        // Get the employee's id
        $eid = $_SESSION['e_id'];
        // Get the employee's company id
        $emp_org_id = $_SESSION['e_org_id'];
        // Get the time of the start of the break. This will be a unix time
        $timestamp = $_POST['timestamp'];
        // Find the entry that hasn't been submitted
        $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$eid';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Go throught the results
        while ($row = $result->fetch_assoc()) {
            // Get the entry time id that hasn't been submitted
            $time_id= $row['time_id'];
        }
        // Put the break into the database
        $sql = "INSERT INTO timeGeneral (breakstart, break_id, submitted, emp_id) VALUES ('$timestamp','$time_id','$sumbitted','$eid');";
        // Run the sql
        mysqli_query($conn, $sql);   
    } else {
        // Send them back to home page
        header("Location: ./index.php");        
    }