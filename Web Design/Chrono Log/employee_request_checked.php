<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['message_id'])) {
        // Creates Connection
        include 'includes/dbh.inc.php';
        // Gets the message id you are updating
        $message_id = $_POST['message_id'];
        // Change the read_status to read
        $sql = "UPDATE message SET read_status='Yes' WHERE id='$message_id';";
        // Run the SQL
        $result = mysqli_query($conn, $sql);
    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }