<?php

session_start();
include 'includes/dbh.inc.php';

$eid = $_SESSION['e_id'];
echo $eid;
/*
$sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$eid';";
$result = mysqli_query($conn, $sql);
while ($row = $result->fetch_assoc()) {
    $timestamp = $row['timestamp'];
}
*/