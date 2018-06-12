<?php

// Start a session
session_start();
// Connect to the database
include 'includes/dbh.inc.php';

$filter = $_POST['filter'];
if ($filter != 'none') {
    $sql = "SELECT * FROM timeGeneral WHERE submitted ='yes' AND project_id = '$filter';";
} else {
    $sql = "SELECT * FROM timeGeneral WHERE submitted ='yes';";
}

$emp_id = $_SESSION['e_id'];
$result = mysqli_query($conn, $sql);

while ($row = $result->fetch_assoc()) {
    if ($row['emp_id']===$emp_id){
        
        echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
        echo "<div id='projectBox' style='width: 97%; height:50px;
        margin:0 auto;
        background-color: rgb(144, 223, 255);
        border-radius: 4px;font-size:16px;'>
        <p>";
        
        
        echo "<div style='float:left;margin-left:12px;'>";
        echo "Date: ";
        $time_start = $row['time_start'];
        echo date("Y M d",$time_start);
        echo " | Time: ";
        echo  $row['time'];

        $pid = $row['project_id'];
        if ($pid == 0) {
            $project_name = '---- No Project ----';
        } else {
            $sql = "SELECT project_name FROM projects WHERE project_id = '$pid';";
            $result2 = mysqli_query($conn, $sql);
            while ($row2 = $result2->fetch_assoc()) {
                $project_name = $row2['project_name'];
            }
        }

        echo " | Project name: ";
        if (strlen($project_name) > 30) {
            $project_name = substr($project_name, 0, 27)." ...";
        }
        echo $project_name;
        echo "</div>";

        $description = $row['des'];
        $start_time = $row['time_start'];
        $start = date("g:i",$start_time);
        $start_diem = date("A",$start_time);

        $end_time = $row['time_end'];
        $end = date("g:i",$end_time);
        $end_diem = date("A",$end_time);
        $datastring_date = $row['date'];

        $tid = $row['time_id'];
        
        
        echo "<button value='$tid' data-start='$start' data-startdiem ='$start_diem' data-end='$end' data-enddiem='$end_diem' data-date='$datastring_date' data-description='$description' data-project='$pid' class='edit_entry' name='time_id' style=' width: 100px;
        height: 30px;
        position:relative;
        float:right;
        margin-right:20px;
        margin-top:10px;
        border: none;
        background-color: #f3f3f3;
        font-family: arial;
        font-size: 16px;
        color: #111;
        cursor: pointer;'>Edit</button>";
        
        // Creates the info button to get the information on an entry
        echo "<button type='submit' value='$tid' class='info_button_managetime' name='time_id' style=' width: 100px;
        height: 30px;
        position:relative;
        float:right;
        margin-right:20px;
        margin-top:10px;
        border: none;
        background-color: #f3f3f3;
        font-family: arial;
        font-size: 16px;
        color: #111;
        cursor: pointer;'>Info</button>";
        

        
        echo "</p></div>";
        echo "</div>";
        /*
        $totalHours = $totalHours + $hours;
        $totalMinutes = $totalMinutes + $minutes;
        $totalSeconds = $totalSeconds + $seconds;
        */
    }
}