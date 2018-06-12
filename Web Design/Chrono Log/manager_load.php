<?php

// Create the connection to the database
include 'includes/dbh.inc.php';
// Starts a session
session_start();

echo "
    <select id='manager_id' name='manager_id' style='width: 150px;
        margin-top:20px;
        margin-left:20px;
        height: 40px;
        float:left;
        border: none;
        background-color: rgb(200, 200, 200);
        font-family: arial;
        font-size: 16px;'>";

         

            // Get the company name 
            $org_id = $_SESSION['u_org_id'];
            // Get all the managers from that company
            $sql = "SELECT * FROM managers WHERE manager_org_id = '$org_id' AND status='active';";
            // Put the result into $result
            $result = mysqli_query($conn, $sql);
            

            // Put each manager into an option 
            while ($row = $result->fetch_assoc()) {
                // Default $added to no text
                $added = "";  
                // Get the project_id
                $pid = $_SESSION['project_id'];
                // Get the manager's email 
                $email = $row['manager_email'];
                // Get the manager's id
                $manager_id = $row['manager_id'];
                // Find if this manager is assigned to this project already
                $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
                // Put the result into $result2
                $result2 = mysqli_query($conn, $sql2);
                // Put the number of results into $resultCheck
                $resultCheck = mysqli_num_rows($result2);
                // See if there is more than 0 results
                if ($resultCheck > 0) {
                    // More than 0, so tell user in the option they have already been added
                    $added = " (Already added to project)";
                }
                // Give the manager in an option
                echo "<option value='$manager_id'>$email $added</option>";
            }
        
echo   "</select>";
