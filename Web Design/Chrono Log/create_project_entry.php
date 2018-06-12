<?php

    // Get the entry id
    $tid = $row['time_id'];
    // Get the employee id
    $emp_id = $row['emp_id'];
    // Find the employee that the entry is associated to
    $sql2 = "SELECT * FROM employees WHERE emp_id = '$emp_id'";
    // Put the result into $result2
    $result2 = mysqli_query($conn, $sql2);
    // Go through results
    while ($row2 = $result2->fetch_assoc()) {
        // Get the employee first name
        $datastring_first = $row2['emp_first'];
        // Get the employee last name
        $datastring_last = $row2['emp_last'];
    }
    // Get the date of the entry
    $datastring_date = $row['date'];
    // Get entry time or length
    $time = $row['time'];
    // Create a string with the name, date, and length of entry
    $data_string = "First Name: ".$datastring_first." | Last Name: ".$datastring_last." | Date: ".$datastring_date." | Time: ".$time;
    // converts and adds the time into seconds
    $array = explode(':', trim($time, ':'));
    // Add all the hours time to the total seconds
    $total_seconds += intval($array[0]) * 3600;
    // Add all the minutes time to the total seconds
    $total_seconds += intval($array[1]) * 60;
    // Add all the seconds time to the total seconds
    $total_seconds += intval($array[2]);
    // Get the description of the project
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
<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
    <div id='projectBox' style='width: 97%; height:50px;
        margin:0 auto;
        background-color: rgb(144, 223, 255);
        border-radius: 4px;font-size:16px;'>

        <!-- Create the area that displays the text or info on the entry -->
        <div style='float:left;margin-left:12px;'>
            <?php
                // Check if $data_string is longer than 82 characters long
                if (strlen($data_string) > 82) {
                    // Cut down the string length and output it
                    echo substr($data_string, 0, 82)." ...";
                } else {
                    // Output the string
                    echo $data_string;
                }
            ?>
        </div>

        <!-- Create the check box for each entry -->
        <label style = 'margin-top:10px; float:right; margin-right:15px;;' class="checkbox-container">
            <input class='entry_check' form='delete_selected_form' type="checkbox" name='num[]' value='<?php echo $row['time_id']; ?>'>
            <span class="checkmark"></span>
        </label>

        <?php
            // Button to get the info about the entry
            echo "<button type='submit' value='$tid'  class='info_button_managetime entry-button-style-1' name='time_id'>Info</button>";
            // Edit Entry Button
            echo "<button value='$tid' data-start='$start' data-startdiem ='$start_diem' data-end='$end' 
                data-enddiem='$end_diem' data-date='$datastring_date' data-description='$description' 
                class='time_id entry-button-style-1' name='time_id'>Edit</button>";
        ?>

    </div>
</div>
<!-- End entry line -->