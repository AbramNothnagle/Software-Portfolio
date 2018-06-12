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
        $sql = "SELECT * FROM managers WHERE manager_uid='$uid' OR manager_email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['manager_pwd']);
                if($hashedPwdCheck == false){
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif($hashedPwdCheck == true){
                    //Log in the user here
                    $_SESSION['m_id'] = $row['manager_id'];
                    $_SESSION['m_first'] = $row['manager_first'];
                    $_SESSION['m_last'] = $row['manager_last'];
                    $_SESSION['m_email'] = $row['manager_email'];
                    $_SESSION['m_uid'] = $row['manager_uid'];
                    $_SESSION['m_org_id'] = $row['manager_org_id'];
                    $_SESSION['m_org_name'] = $row['manager_org_name'];
                    header("Location: ../index.php?login=success");
                    exit();
                }

                
            }
        }

    }
}