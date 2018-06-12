<?php

// Start the session
session_start();
// Create the connection to database
include 'includes/dbh.inc.php';
// Get the company's id
$org_id = $_SESSION['u_org_id'];
// Get all company's messages
$sql = "SELECT * FROM message WHERE org_name = '$org_id'";
// Put the result into $result
$result = mysqli_query($conn, $sql);
// Get the total number of messages
$resultCheck = mysqli_num_rows($result);
// check if there are no messages
if ($resultCheck < 1){
    // Leave the php
    exit();
// If there are messages, do the following
} else {
    // Go through the results
    while ($row = $result->fetch_assoc()) {
        
        // Creates each message line that will go in the notifications box
        echo 
        "
        <div style='width:100%;height:54px;background-color:white'>
            <div id='projectBox' style='width: 95%; height:50px;
                margin:0 auto;
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'>
                
                <div style='float:left;margin-left:12px;line-height:48px;'>
                    <p>Employee E-mail: '".$row['emp_email']."' | Message: '".$row['message']."'</p>
                </div>
            </div>
        </div>
        ";
        
    }
}

