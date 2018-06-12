<?php

session_start();

if (isset($_POST['submit'])){

    include_once 'dbh.inc.php';

    $id = $_SESSION['u_id'];
   
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $hours = mysqli_real_escape_string($conn, $_POST['hours']);
    $sql = "UPDATE users SET user_date=$date WHERE user_id=$id";
    mysqli_query($conn, $sql);
    $sql = "UPDATE users SET user_hours=$hours WHERE user_id=$id";
    mysqli_query($conn, $sql);
    
    header("Location: ../index.php");
    exit();

}