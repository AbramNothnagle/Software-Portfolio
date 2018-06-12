<?php
    // Start a session
    session_start();
    // Create the connection to the database
    include 'includes/dbh.inc.php';
    // put the session project_id into $pid
    $pid = $_SESSION['project_id'];
    // Start to total seconds counter to 0
    $total_seconds = 0; 
    // Get all of the project entries
    $sql = "SELECT * FROM timeGeneral WHERE project_id = '$pid';";
    // Put the result into $result
    $result = mysqli_query($conn, $sql);
    // Get the number of entries
    $resultCheck = mysqli_num_rows($result);
    
    // If there are more than 0 entries, found_entries value will be found
    if ($resultCheck > 0) {
        echo "<input type='hidden' value='found' id='found_entries'>";
    } else {
        echo "<input type='hidden' value='not_found' id='found_entries'>";
    }
                
    // Creating the boxes that show times worked on the project
    while ($row = $result->fetch_assoc()) {
        
        include 'create_project_entry.php';
        
    }


?>

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

<form method="POST" id='delete_selected_form'>
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
        2px 2px 1px #e5e5e5;'>
        <?php

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
        ?>  
    </p>
</div>
</div>