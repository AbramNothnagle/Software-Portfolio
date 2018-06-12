<?php
session_start();

include_once 'dbh.inc.php';

$uid = $_SESSION['u_id'];
$_SESSION = $_
echo $uid;
$hour = "SELECT user_hours FROM users WHERE user_uid='$uid'";
$result = mysqli_query($conn, $hour);
echo $result;