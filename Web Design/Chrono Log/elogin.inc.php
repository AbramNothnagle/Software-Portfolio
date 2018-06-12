<?php

session_start();

if (isset($_POST['submit'])){

    include_once 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Error handlers
    //Check if inputs are empty
    if (empty($uid) || empty($pwd)){
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM employees WHERE emp_uid='$uid' OR emp_email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['emp_pwd']);
                if($hashedPwdCheck == false){
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif($hashedPwdCheck == true){
                    //Log in the user here
                    $_SESSION['e_id'] = $row['emp_id'];
                    $_SESSION['e_first'] = $row['emp_first'];
                    $_SESSION['e_last'] = $row['emp_last'];
                    $_SESSION['e_email'] = $row['emp_email'];
                    $_SESSION['e_uid'] = $row['emp_uid'];
                    $_SESSION['e_org'] = $row['emp_org'];
                    $_SESSION['e_org_name'] = $row['emp_org_name'];
                    header("Location: ../index.php?login=success");
                    exit();
                }

                
            }
        }

    }
}