<?php

// start a session
session_start();

if (isset($_POST['submit'])){

    include_once 'dbh.inc.php';
    $org = mysqli_real_escape_string($conn, $_POST['org']);
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Error handlers
    //Check for empty fields
   
if (empty($first) || empty($last) ||  empty($email) ||  empty($uid) || empty($pwd)){
    header("Location: ../manager_account.php?signup=empty");
    exit();
} else {
    //Check if characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
        header("Location: ../manager_account.php?signup=invalid");
        exit();
    } else {
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../manager_account.php?signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM managers WHERE manager_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                header("Location: ../manager_account.php?signup=usertaken");
                exit();
            } else{
                //Hashing the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $sql = "INSERT INTO managers (manager_first, manager_last, manager_email, manager_uid, manager_pwd, manager_org_id, status) VALUES ('$first','$last','$email','$uid','$hashedPwd','$org','active');";
                mysqli_query($conn, $sql);
                // Let the user know they created the manager
                $_SESSION['manager_account_created'] = 'true';
                header("Location: ../manager_account.php?signup=success");
                exit();
            }
        }
    }
}

} else {
    header("Location: ../maccount.php");
    exit();
}