<?php

if (isset($_POST['submit'])){

    include_once 'dbh.inc.php';
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $org = mysqli_real_escape_string($conn, $_POST['org']);
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Error handlers
    //Check for empty fields
   
if (empty($first) || empty($last) ||  empty($email) ||  empty($uid) || empty($pwd)){
    header("Location: ../eaccount.php?signup=empty");
    exit();
} else {
    //Check if characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
        header("Location: ../eaccount.php?signup=invalid");
        exit();
    } else {
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../eaccount.php?signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM employees WHERE emp_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                header("Location: ../eaccount.php?signup=usertaken");
                exit();
            } else{
                //Hashing the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $sql = "INSERT INTO employees (emp_first, emp_last, emp_email, emp_uid, emp_pwd, emp_org, emp_org_name) VALUES ('$first','$last','$email','$uid','$hashedPwd','$id','$org');";
                mysqli_query($conn, $sql);
                header("Location: ../eaccount.php?signup=success");
                exit();
            }
        }
    }
}

} else {
    header("Location: ../eaccount.php");
    exit();
}