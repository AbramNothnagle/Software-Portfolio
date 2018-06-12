<?php

    // Create the employee line thats displays their email and name. It also has a button to select that employee
    echo 
    "
    <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
        <div id='projectBox' style='width: 97%; height:50px;
        margin:0 auto;
        background-color: rgb(144, 223, 255);
        border-radius: 4px;font-size:16px;'>
        
            <div style='float:left;margin-left:12px;'>
                <p>First Name: '".$row['emp_first']."' | Last Name: '".$row['emp_last']."' | Email: '".$row['emp_email']."'</p>
            </div>           
        </div>";
    // Check to see if an admin is signed in
    if (isset($_SESSION['u_id'])) {
        echo "<form style='position:relative; margin-top:-60px; margin-left: 74%;' method='GET' action='employee_entries.php'>";
    // Check to see if a manager is signed in
    } elseif (isset($_SESSION['m_id'])) {
        echo "<form style='position:relative; margin-top:-60px; margin-left: 74%;' method='GET' action='employee_entries_for_managers.php'>";
    }

    // Create the button to select the employee
    echo "<input type='hidden' name='emp_id' value='".$row['emp_id']."'>
        <button class='entry-button-style-1' type ='submit' style=' width: 180px; margin-right:40px;'>
            Select Employee
        </button>
        </form>";
    echo "</div>";
    // ----- End employee line -----