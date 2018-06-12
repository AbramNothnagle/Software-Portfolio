<?php



session_start();

// Creates Connection
include 'includes/dbh.inc.php';


$time_id = $_POST['id'];
$date = $_POST['date'];
$hours = $_POST['hours'];


$sql = "UPDATE time SET hours='$hours' WHERE time_id='$time_id';";
$result = mysqli_query($conn, $sql);
$sql = "UPDATE time SET date='$date' WHERE time_id='$time_id';";
$result = mysqli_query($conn, $sql);


?>