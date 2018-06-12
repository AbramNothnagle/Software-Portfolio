<?php


    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['type'])) {
        // Creates Connection
        include 'includes/dbh.inc.php';
        // Gets the filter type and date the user is looking for
        if (isset($_POST['date_format'])) {
            $date = $_POST['date_format'];
        }
        // Gets the type of filter
        $type = $_POST['type'];

        
        // Check if a admin is signed in
        if (isset($_SESSION['u_id'])) {
            // Get the company id
            $org_id = $_SESSION['u_org_id'];
        // Check if a manager is signed in
        } elseif ($_SESSION['m_id']) {
            // Get the company id
            $org_id = $_SESSION['m_org_id'];
        }

        // Gets the employee's id that is being viewed
        $emp_id = $_SESSION['current_emp_id'];
        // Get all of the employees entries 
        $sql = "SELECT * FROM timeGeneral WHERE emp_id = '$emp_id'";
        // Put the result into result
        $result = mysqli_query($conn, $sql);
        // Check how many entries there were
        $resultCheck = mysqli_num_rows($result);
        // If there were none do this
        if ($resultCheck < 1) {
            echo "  
            <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
                <div id='assign_project_box' style='width: 97%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px;'>
                
                <button class='add_entry' style='cursor:pointer;width: 100%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px; '>
                    + ADD ENTRY
                </button>
            
                </div>
            </div>

            <div style='margin-top:0px; font-size:20px;'>This Employee Has No Entries</div>
            ";
            // Leave the php code
            exit();
        }
        // Initialize total seconds to 0
        $total_seconds = 0;
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            
            // Checks the filter type -Year-
            if ($type == 'year') {   
                // Format the date to get just the year     
                $date_format = substr($row['date'], 0, 4);
                // check if the dates match
                if ($date == $date_format) {
                    // Add the code that will create the entry line
                    include 'create_employee_entry.php'; 
                }
            // -Month-
            } else if ($type == 'month') {
                // Format the date to get just the year and month 
                $date_format = substr($row['date'], 0, 7); 
                // check if the dates match    
                if ($date == $date_format) {
                    // Add the code that will create the entry line
                    include 'create_employee_entry.php';
                }
            // -Day-
            } else if ($type == 'day') {
                // check if the dates match
                if ($date == $row['date']) {
                    // Add the code that will create the entry line            
                    include 'create_employee_entry.php';
                }
            }
        }

        // Area for the button to add more entries to project 
        echo "  
            <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
                <div id='assign_project_box' style='width: 97%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px;'>
        
                <button class='add_entry' style='cursor:pointer;width: 100%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px; '>
                    + ADD ENTRY
                </button>

                </div>
            </div>

            <form method='POST' id='delete_selected_form'>
            </form>";
        
        // shows the total time of the entries 
        echo "
        <div class='timeStyle' style='font-size:24px;padding: 2px; margin:0 auto; background-color:#cbcbcb;width:200px; border:2px;border-radius:4px;border-style: outset; height:30px; margin-top:10px; line-height:30px;'>
        <p style='    color: #b2b2b2;
        background-color: #cbcbcb;
        letter-spacing: .1em;
        font-weight: 900;
        text-align: center;
        text-shadow:
        -1px -1px 1px #7f7f7f,
        2px 2px 1px #e5e5e5;'>";


        // Get the hours of total seconds. Total seconds is the time in seconds of all entries combined
        $hours = floor($total_seconds/3600);
        // Take the hours off total seconds
        $total_seconds = ($total_seconds - $hours * 3600);
        // Get the minutes part of the total time from all entries
        $minutes = floor($total_seconds/60);
        // Get the seconds part of the total time from all entries
        $seconds = ($total_seconds - $minutes * 60);
        
        if ( $hours < 10) {
        echo "0".$hours.":";
        } else {
        echo $hours.":";
        }
        if ( $minutes < 10) {
        echo "0".$minutes.":";
        } else {
        echo $minutes.":";
        }
        if ( $seconds < 10) {
        echo "0".$seconds;
        } else {
        echo $seconds;
        }
        echo
        "             
        </p>
        </div>";

    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }
