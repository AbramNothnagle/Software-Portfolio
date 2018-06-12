<?php

// Create the connection to the database
include 'includes/dbh.inc.php';
// Starts a session
session_start();

echo "    
    <select id='employee_id' name='employee_id' style='width: 150px;
        margin-top:20px;
        margin-left:20px;
        height: 40px;
        float:left;
        border: none;
        background-color: rgb(200, 200, 200);
        font-family: arial;
        font-size: 16px;'>";
       
            // Get the company id
            $org_id = $_SESSION['u_org_id'];
            // Get all the managers from that company
            $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status= 'active';";
            // Put the result into $result
            $result = mysqli_query($conn, $sql);
            

            // Put each employee into an option 
            while ($row = $result->fetch_assoc()) {
                // Set added to no set
                $added = "";
                // Get the project_id
                $pid = $_SESSION['project_id'];
                // Get the employee's email
                $email = $row['emp_email'];
                // Get the employee's id
                $emp_id = $row['emp_id'];
                // Find if the employee has been assigned to this project already
                $sql2 = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id' AND project_id = '$pid';";
                // Put result in to $result2
                $result2 = mysqli_query($conn, $sql2);
                // Get the number of results
                $resultCheck = mysqli_num_rows($result2);
                // If there is more than 0, they have been added
                if ($resultCheck > 0){
                    // Let the user know they have been added
                    $added = " (Already added to project)";
                }
                // Put the employee in an option
                echo "<option value='$emp_id'>$email $added</option>";
            }
            //echo "<input type='hidden' name='added_emp' value='$add'>";

        
echo "</select>";