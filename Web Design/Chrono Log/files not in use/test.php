
<?php
session_start();

include 'includes/dbh.inc.php';  

$eid = $_SESSION['e_id'];
$time = $_POST['time1'];
settype($time, "string");
echo $time;
echo $eid;
$sql = "UPDATE employees SET time = $time WHERE emp_id = $eid";
$result = mysqli_query($conn, $sql);

?>