<?php
    
    session_start();
    include 'includes/dbh.inc.php';
    $time = time();
    
    $eid = $_SESSION['e_id'];
    $sql2 = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$eid'";
    $result = mysqli_query($conn, $sql2);
    while($row = $result->fetch_assoc()) {
        $time_id = $row['time_id'];    
    }
    
    
    $sql = "INSERT INTO timeGeneral (breakstart, submitted, break_id) VALUES ('$time','break','$time_id')";
    mysqli_query($conn, $sql);
    
    