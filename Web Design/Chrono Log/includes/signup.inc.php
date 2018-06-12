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
    header("Location: ../signup.php?signup=empty");
    exit();
} else {
    //Check if characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
        header("Location: ../signup.php?signup=invalid");
        exit();
    } else {
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?signup=email");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                header("Location: ../signup.php?signup=usertaken");
                exit();
            } else{ $sql = "SELECT * FROM users WHERE org_name = '$org'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
            }  else {  
                //Hashing the password
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                //Insert the user into the database
                $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first','$last','$email','$uid','$hashedPwd');";
                mysqli_query($conn, $sql);
                
                // Get the last inserted id
                $last_insert_id = $conn->insert_id;

                $sql = "UPDATE users SET org_id = '$last_insert_id' WHERE user_id ='$last_insert_id';";
                mysqli_query($conn, $sql);
    
                $sql = "INSERT INTO company_info_and_settings (org_name, org_id, allow_employee_time_edit, allow_manager_time_edit) VALUES ('$org','$last_insert_id','no','yes');";
                mysqli_query($conn, $sql);

                $_SESSION['new_admin_created'] = 'true';
                header("Location: ../signup.php?signup=success");
                exit();
              }
            }
        }
    }
}

} else {
    header("Location: ../signup.php");
    exit();
}