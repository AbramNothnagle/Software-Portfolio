<?php


    include_once 'dbh.inc.php';

    if(isset($_POST['delete_project'])){
        $pid = $_POST['project_id'];
        $sql2 = "DELETE FROM work WHERE user_id = $pid";
        mysqli_query($conn, $sql2);
    }
