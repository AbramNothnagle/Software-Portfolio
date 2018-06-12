<?php

if (isset($_POST['submit'])){

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $org = mysqli_real_escape_string($conn, $_POST['org']);
    //Error handlers
    //Check for empty fields
   
if (empty($first) || empty($last) ||  empty($email) ||  empty($uid) || empty($pwd) || empty($org)){
    header("Location: ../signupNewAdmin.php?signup=empty");
    exit();
} else {
    //Check if characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
        header("Location: ../signupNewAdmin.php?signup=invalid");
        exit();
    } else {
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signupNewAdmin.php?signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                header("Location: ../signupNewAdmin.php?signup=usertaken");
                exit();
            } else{
                //Hashing the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd, org_name) VALUES ('$first','$last','$email','$uid','$hashedPwd','$org');";
                mysqli_query($conn, $sql);
                header("Location: ../index.php?signup=success");
                exit();
            }
        }
    }
}

} else {
    header("Location: ../index.php");
    exit();
}