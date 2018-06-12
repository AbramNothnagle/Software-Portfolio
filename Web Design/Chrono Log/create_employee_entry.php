<?php

    // Get the project id
    $project_id = $row['project_id'];
    // If the project_id was 0 it wasn't assigned to a project
    if ($project_id == 0) {
        // Set the string to say no project since it isn't part of one
        $data_string_project = "---- No Project ----";
    } else {
        // Get the projects with this entries project id and has the user's org id
        $sql = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id = '$org_id';";
        // Put the result into $result2
        $result2 = mysqli_query($conn, $sql);
        // Go through each result
        while ($row2 = $result2->fetch_assoc()) {
            // Get the project's name
            $project_name = $row2['project_name'];
        }
        // Put $data_string_project as the project name
        $data_string_project = $project_name;

    }

    // Check if the string length of the project name is longer than 27 characters
    if (strlen($data_string_project) > 27) {
        // Cut down the length of the string
        $data_string_project = substr($data_string_project, 0, 25)." ...";
    } 
    
    // Set the date of the entry
    $data_string_date = $row['date'];
    // Get the time of the entry
    $data_string_time = $row['time'];
    // Combine project, date, and time into one string
    $data_string = "Project Name: ".$data_string_project." | Date: ".$data_string_date." | Time: ".$data_string_time;

    // Get the time of the entry
    $time = $row['time'];
    // converts and adds the time into seconds
    $array = explode(':', trim($time, ':'));
    $total_seconds += intval($array[0]) * 3600;
    $total_seconds += intval($array[1]) * 60;
    $total_seconds += intval($array[2]);
    // Get the id of the entry
    $tid = $row['time_id'];
    // Get the description of the entry
    $description = $row['des'];
    // Get the start time of the entry
    $start_time = $row['time_start'];
    // Format the start time to a 12 hour clock hour and mintues
    $start = date("g:i",$start_time);
    // Get the AM/PM of the start time
    $start_diem = date("A",$start_time);
    // Get the end time of the entry
    $end_time = $row['time_end'];
    // Format the end time to a 12 hour clock hour and mintues
    $end = date("g:i",$end_time);
    // Get the AM/PM of the end time
    $end_diem = date("A",$end_time);

?>

<!-- Start of div that creates the entry line -->
<div style='width:100%;height:54px;background-color:rgb(247, 247, 247);'>
    <div id='projectBox' style='width: 97%; height:50px;
        margin:0 auto;
        background-color: rgb(144, 223, 255);
        border-radius: 4px;font-size:16px;'>

        <!-- Create the area that displays the text or info on the entry -->
        <div style='float:left;margin-left:12px;'> 
            <?php
                // Check if the string length of $data_string is longer than 78 characters
                if (strlen($data_string) > 78) {
                    // Cut down the length of $data_string and output it
                    echo substr($data_string, 0, 76)." ...";
                } else {
                    // output $data_string
                    echo $data_string;
                }
            ?>
        </div>  

        <!-- Creates the checkbox on a line -->
        <label style = 'margin-top:10px; float:right; margin-right:15px;' class="checkbox-container">
            <input class='entry_check' type="checkbox" name='num[]' value='<?php echo $row['time_id']; ?>'>
            <span class="checkmark"></span>
        </label>

        <?php
            // Creates the info button on a line
            echo "<button type='submit' value='$tid' class='info_button_managetime entry-button-style-1' name='time_id'>Info</button>";
            // Creates the edit button on a line
            echo "<button type='button' data-start='$start' data-startdiem ='$start_diem' data-end='$end' 
                data-enddiem='$end_diem' data-date='$data_string_date' data-description='$description' value='$tid'  
                class='edit entry-button-style-1' name='time_id' style=' width: 60px;'>Edit</button>";

        ?>

    </div>
</div>
<!-- End of entry line -->