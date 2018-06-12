<?php

    // Start a session
    session_start();
    // Connect to the database
    include 'includes/dbh.inc.php';
    // Get the entry id
    $time_id = $_POST['time_id'];
    // Get the entry from the database
    $sql = "SELECT * FROM timeGeneral WHERE time_id = '$time_id';";
    // Put the result into $result
    $result = mysqli_query($conn, $sql);
    // Go through the results
    while ($row = $result->fetch_assoc()) {
        echo "<div style='background-color:#f4f9ff; '>";
        echo "<div style='margin-left:20px; height:30px; '>";
        // echo "<p style='margin-top:20px;'>";
        echo "Start Time: ";
        $time_start = $row['time_start'];
        echo date("Y M d h:i:s A",$time_start);
        // echo "</p>";
        echo "</div>";
        echo "</div>";
        echo "<div style='background-color:#f4f9ff; border-bottom: 2px solid rgb(200, 200, 200);'>";
        echo "<div style='margin-left:20px; height:30px'>";
        echo " End Time: ";
        $time_end = $row['time_end'];
        echo date("Y M d h:i:s A",$time_end);
        echo "</div>";
        echo "</div>";
    }

    echo "<div style='font-size:26px;'><p style='margin: 0 auto;width:70px;'>Breaks</p></div>";
    $sql = "SELECT * FROM timeGeneral WHERE break_id = '$time_id';";
    $result = mysqli_query($conn, $sql);

    echo "<div style='overflow: scroll;height:386px;border-bottom: 2px solid rgb(200, 200, 200);'>";
    while ($row = $result->fetch_assoc()) {
        
        echo "<div style='width:100%;height:54px;background-color:white'>";
        echo "<div style='width: 95%; height:50px;
            margin:0 auto;
            background-color: rgb(144, 223, 255);
            border-radius: 4px;font-size:16px;'>
            <p>";
        echo "<div style='float:left;margin-left:12px;line-height:48px;'>";
        echo " Break Start: ";
        $breakstart = $row['breakstart'];
        echo date("Y M d h:i:s A",$breakstart);
        echo " | Break End: ";
        $breakend = $row['breakend'];
        echo date("Y M d h:i:s A",$breakend);
        echo "</div>";
        
        echo "</p>";
        
        echo "</div>";
        echo "</div>";

    }
    echo "</div>";