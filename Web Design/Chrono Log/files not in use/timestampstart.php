<?php
    
    session_start();
    include 'includes/dbh.inc.php';
    $sumbitted = "no";
    $eid = $_SESSION['e_id'];
    $emp_org_name = $_SESSION['e_org_name'];
    $emp_first = $_SESSION['e_first'];
    $emp_last = $_SESSION['e_last'];
    $emp_email = $_SESSION['e_email'];
    $timestamp = $_POST['timestamp'];

    $sql = "INSERT INTO timeGeneral (timestart, submitted, emp_id, emp_org_name, emp_first, emp_last, emp_email) VALUES ('$timestamp','$sumbitted','$eid','$emp_org_name','$emp_first','$emp_last','$emp_email');";
    mysqli_query($conn, $sql);   



    // $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$eid';";
    // $result = mysqli_query($conn, $sql);
    // $resultCheck = mysqli_num_rows($result);
    // $total_break_time = 0;
    // while ($row = $result->fetch_assoc()) {
    //     $time_id = $row['time_id'];
    // }
    // if ($resultCheck > 0){
        
    //     $sql2 = "SELECT * FROM timeGeneral WHERE submitted = 'break' AND break_id = '$time_id';";
    //     $result2 = mysqli_query($conn, $sql2);
    //     while ($row = $result2->fetch_assoc()) {  
    //         $break_start = $row["breakstart"];
    //     }
        
    //     $break_time = $time - $break_start;
        
    //     $sql3 = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$eid';";
    //     $result3 = mysqli_query($conn, $sql3);
    //     while ($row = $result3->fetch_assoc()) {  
    //         $time_stamp = $row["time_stamp"];
    //     }
        
    //     $new_time = $time_stamp + $break_time;
        
    //     echo $new_time;

    //     $sql7 = "UPDATE timeGeneral SET time_stamp='$new_time' WHERE submitted='no' AND emp_id = '$eid';";
    //     $result4 = mysqli_query($conn, $sql7);
    //     $sql4 = "UPDATE timeGeneral SET breakend='$time' WHERE submitted='break';";
    //     $result5 = mysqli_query($conn, $sql4);
    //     $sql5 = "UPDATE timeGeneral SET submitted='break_done' WHERE submitted='break';";
    //     $result6 = mysqli_query($conn, $sql5);

    // } else {
    //     $sql6 = "INSERT INTO timeGeneral (time_stamp, submitted, emp_id, emp_org_name, emp_first, emp_last, emp_email) VALUES ('$time','$sumbitted','$eid','$emp_org_name','$emp_first','$emp_last','$emp_email');";
    //     mysqli_query($conn, $sql6);
    //     echo $time;
    // }
    
