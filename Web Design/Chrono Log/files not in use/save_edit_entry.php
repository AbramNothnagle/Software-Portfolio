<?php



session_start();

// Creates Connection
include 'includes/dbh.inc.php';


$time_id = $_POST['id'];
$date = $_POST['date'];
$hours = $_POST['hours'];
$description = $_POST['description'];

if ($hours != null) {
    $sql = "UPDATE time SET hours='$hours' WHERE time_id='$time_id';";
    $result = mysqli_query($conn, $sql);
}
if ($date != null) {
    $sql = "UPDATE time SET date='$date' WHERE time_id='$time_id';";
    $result = mysqli_query($conn, $sql);
}
if ($description != null) {
    $sql = "UPDATE time SET des='$description' WHERE time_id='$time_id';";
    $result = mysqli_query($conn, $sql);
}


?>