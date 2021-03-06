<?php


// Start a session
session_start();
// Creates Connectino
include 'includes/dbh.inc.php';
// Gets the filter type and date the user is looking for
if (isset($_POST['date_format'])) {
    $date = $_POST['date_format'];
}
// Gets the type of filter
$type = $_POST['type'];
// Gets the company id
//
if (isset($_SESSION['u_id'])) {
    $org_id = $_SESSION['u_org_id'];
} elseif ($_SESSION['m_id']) {
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
if ($resultCheck < 1){
    echo "  <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
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
</div>";
    echo "<div style='margin-top:0px; font-size:20px;'>This Employee Has No Entries</div>";
    exit();
}
$total_seconds = 0;
while ($row = $result->fetch_assoc()) {
       
    // Checks the filter type
    if ($type == 'year') {        
        $date_format = substr($row['date'], 0, 4);
        
        if ($date == $date_format) {
            
            include 'create_employee_entry.php'; 
        }
    } else if ($type == 'month') {
        $date_format = substr($row['date'], 0, 7); 
              
        if ($date == $date_format) {
            
            include 'create_employee_entry.php';

        }
    } else if ($type == 'day') {
        if ($date == $row['date']) {
                        
            include 'create_employee_entry.php';

        }
    }
}

                // Get the current id
                $org_id = $_SESSION['m_org_id'];
                // Get all the sumbitted entries of the employee
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id';";
                // Put the result into $result
                $result = mysqli_query($conn, $sql);
                // Go through the results 
                while ($row = $result->fetch_assoc()) {
                    // Get if the employee should be allowed to edit time
                    $manager_allow_edit = $row['allow_manager_time_edit'];
                }
            if ($manager_allow_edit == 'yes') {
            echo "
                <!-- Area for the button to add more entries to project -->
                <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
                    <div id='assign_project_box' style='width: 97%; height:50px;
                        margin:0 auto;
                        background-color: rgb(218, 218, 218);
                        border-radius: 4px;font-size:16px;'>
                        
                        <button class='add_entry' id='add_entry'style='cursor:pointer;width: 100%; height:50px;
                            margin:0 auto;
                            background-color: rgb(218, 218, 218);
                            border-radius: 4px;font-size:16px; '>
                            + ADD ENTRY
                        </button>
                    
                    </div>
                </div>

<form method='POST' id='delete_selected_form'>
</form> 

<!-- shows the total time of the entries -->
<div class='timeStyle' style='font-size:24px;padding: 2px; margin:0 auto; background-color:#cbcbcb;width:200px; border:2px;border-radius:4px;border-style: outset; height:30px; margin-top:10px; line-height:30px;'>
<p style='    color: #b2b2b2;
background-color: #cbcbcb;
letter-spacing: .1em;
font-weight: 900;
text-align: center;
text-shadow:
-1px -1px 1px #7f7f7f,
2px 2px 1px #e5e5e5;'>";


$hours = floor($total_seconds/3600);
$total_seconds = ($total_seconds - $hours * 3600);
$minutes = floor($total_seconds/60);
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

?>