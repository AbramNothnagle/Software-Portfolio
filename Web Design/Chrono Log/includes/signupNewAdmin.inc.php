<?php

// Starts a session
session_start();

// Check to make sure a proper submission was made
if (isset($_POST['submit'])){

    // Connect to the database
    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $org = mysqli_real_escape_string($conn, $_POST['org_id']);
    //Error handlers
    //Check for empty fields
   
if (empty($first) || empty($last) ||  empty($email) ||  empty($uid) || empty($pwd) || empty($org)){
    header("Location: ../adminaccount.php?signup=empty");
    exit();
} else {
    //Check if characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
        header("Location: ../adminaccount.php?signup=invalid");
        exit();
    } else {
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../adminaccount.php?signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                header("Location: ../adminaccount.php?signup=usertaken");
                exit();
            } else{
                //Hashing the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, org_id) VALUES ('$first','$last','$email','$uid','$hashedPwd','$org');";
                mysqli_query($conn, $sql);
                // Let the user know they created the admin
                $_SESSION['admin_account_created'] = 'true';
                header("Location: ../adminaccount.php?signup=success");
                exit();
            }
        }
    }
}

} else {
    // Send them to the home page
    header("Location: ../index.php");
    exit();
}