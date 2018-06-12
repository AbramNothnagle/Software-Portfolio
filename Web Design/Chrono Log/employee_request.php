<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['message'])) {
        // Creates Connection
        include 'includes/dbh.inc.php';
        // Get the time 
        $time = $_POST['time'];
        // Get the message the employee sent
        $message = $_POST['message'];
        // Get the new date and time to string
        $new_date = $date + ' ' + $time;
        // Get the employee's company id
        $org_id = $_SESSION['e_org_id'];
        // Get the employee's id
        $emp_id = $_SESSION['e_id'];
        // Put the message into the database
        $sql = "INSERT INTO message ( emp_id, read_status, message ,org_id) VALUES ('$emp_id','No','$message','$org_id')";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }
