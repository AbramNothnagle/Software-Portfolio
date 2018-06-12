<?php


echo "<form id='timestamp' action='' method='POST'>
<div style='position: relative; margin: 0 auto;  width: 360px; height: 96px; border: 2px solid black;'>
<input type='button' value='Clock In' onclick='timestamp()'id='clockin' style=' position: absolute; width: 180px; margin-left:-180px;
height: 30px;
color:white;
border: none;
background: linear-gradient(#4ae478, #239c45);

font-family: arial;
font-size: 16px;
color: #111;
cursor: pointer;'
>
</form>

<form method=POST action='".sendTime($conn)."'>
<input id='time1' type='text' name='time1' value='00' style='margin-left:00px; margin-top: 54%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time2' type='text' name='time2' value='00' style='margin-left:00px; margin-top: 54%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time3' type='text' name='time3' value='00' style='margin-left:00px; margin-top: 54%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time4' type='text' name='time4' value='00' style='margin-left:00px; margin-top: 54%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time5' type='text' name='time5' value='00' style='margin-left:00px; margin-top: 54%;width:0;height:0;z-index:-9;position:absolute'>
<button name='submitsendtime' onclick='changebtnTwo()' disabled id='clockout' style=' position: absolute; width: 180px;
height: 30px;
color:white;
border: none;
background: #423d3d;
font-family: arial;
font-size: 16px;
color: #111;
cursor: pointer;'
>Clock Out</button></form>

";


// #423d3d color for disabled buttons



function sendTime($conn){
    if (isset($_POST['submitsendtime'])){
        
    $eid = $_SESSION['e_id'];
    $first = $_SESSION['e_first'];
    $last = $_SESSION['e_last']; 
    $org = $_SESSION['e_org_name'];
    $hours = $_POST['time1'];
    $minutes = $_POST['time2'];
    $seconds = $_POST['time3'];
    $timeStarted = $_POST['time4'];
    $timeEnded = $_POST['time5'];
    $date = date("Y-m-j");
    
    $hoursTotal = $hours + ($minutes/60) + ($seconds/3600);

    $result = mysqli_query($conn, "UPDATE timeGeneral SET emp_first='$first' WHERE submitted='no' AND emp_id = '$eid' ");
    $result2 = mysqli_query($conn, "UPDATE timeGeneral SET emp_last='$last' WHERE submitted='no' AND emp_id = '$eid'");
    $result3 = mysqli_query($conn, "UPDATE timeGeneral SET emp_id='$eid' WHERE submitted='no' AND emp_id = '$eid'");
    $result4 = mysqli_query($conn, "UPDATE timeGeneral SET emp_org_name='$org' WHERE submitted='no' AND emp_id = '$eid'");
    $result5 = mysqli_query($conn, "UPDATE timeGeneral SET hours='$hours' WHERE submitted='no' AND emp_id = '$eid'");
    $result6 = mysqli_query($conn, "UPDATE timeGeneral SET minutes='$minutes' WHERE submitted='no' AND emp_id = '$eid'");
    $result7 = mysqli_query($conn, "UPDATE timeGeneral SET seconds='$seconds' WHERE submitted='no' AND emp_id = '$eid'");
    $result8 = mysqli_query($conn, "UPDATE timeGeneral SET date='$date' WHERE submitted='no' AND emp_id = '$eid'");
    $result9 = mysqli_query($conn, "UPDATE timeGeneral SET hoursTotal='$hoursTotal' WHERE submitted='no' AND emp_id = '$eid'");
    $result15 = mysqli_query($conn, "UPDATE timeGeneral SET submitted='yes' WHERE submitted='no' AND emp_id = '$eid'");
    
    }
}