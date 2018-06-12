<?php

// Start a session
session_start();
// Connect to the database
include 'includes/dbh.inc.php';

$org_id = $_SESSION['u_org_id'];

$sql = "SELECT * FROM message WHERE read_status='No' AND org_id = '$org_id'";

$result = mysqli_query($conn, $sql);

$resultCheck = mysqli_num_rows($result);

if ($resultCheck < 1){
    
    exit();
} else {

    while ($row = $result->fetch_assoc()) {
        
        echo "<div style='width:100%;height:54px;background-color:white'>";
        echo "<div id='projectBox' style='width: 95%; height:50px;
            margin:0 auto;
            background-color: rgb(144, 223, 255);
            border-radius: 4px;font-size:16px;'>
            <p>";
        echo "<div style='float:left;margin-left:12px;line-height:48px;'>";
        echo " Employee E-mail: ";
        echo $row['emp_email'];
        echo " | Message: ";
        echo $row['message'];
        
        echo "</div>";
        
        echo "</p>";
        
        echo "</div>";
        echo "</div>";

        $mid = $row['id'];
        echo "<button  class='read' value='$mid' name='time_id' style=' width: 100px;
        height: 30px;
        position: absolute;
        margin-top:-44px;
        margin-left:570px;
        border: none;
        background-color: rgb(60, 218, 68);
        font-family: arial;
        font-size: 16px;
        color: #fff;
        cursor: pointer;'>&#10004 Read</button>";



    }
    echo "<div style='width:100%;height:60px;background-color:white'></div>";
}

?>