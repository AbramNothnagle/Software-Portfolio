<?php 

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['time_id'])) {
        // Connect to database
        include 'includes/dbh.inc.php';
        // Get the selected employee id
        $time_id = $_POST['time_id'];
        // put emp_id into variable
        $emp_id = $_SESSION['current_emp_id'];
        // Get the entered description
        $description = $_POST['description']; 
        // Get the selected date
        $date = $_POST['date'];
        // Get the start time
        $start_time = $_POST['start'];
        // Get the start time diem
        $start_diem = $_POST['start_diem'];
        // Get the end time 
        $end_time = $_POST['end'];
        // Get the end time diem
        $end_diem = $_POST['end_diem'];
        // Combine start time into string
        $start_unix = $date." ".$start_time." ".$start_diem;
        // Get unix timestamp of the start time
        $start_unix = strtotime($start_unix);
        // Combine start time into string
        $end_unix = $date." ".$end_time." ".$end_diem;
        // Get unix timestamp of the start time
        $end_unix = strtotime($end_unix);

        // Get the total minutes of the new time
        $time = ($end_unix - $start_unix)/60;
        // Get the hours of the new time
        $hours = floor($time/60);
        // Get the minutes part of the new time. This is not the total minutes
        $minutes = $time - ($hours * 60);
        // If hours is less than 10 add a 0 on to the string
        if ($hours < 10){
            //add a 0 on to the string
            $hours = "0".$hours;
        }
        // If minutes is less than 10 add a 0 on to the string
        if ($minutes < 10){
            //add a 0 on to the string
            $minutes = "0".$minutes;
        }

        // Create the total time worked string
        $time = $hours.":".$minutes.":"."00";
        // Put the data into the database
        $sql = "UPDATE timeGeneral SET time_start = '$start_unix' WHERE time_id = '$time_id';";
        // Execute the sql
        $result = mysqli_query($conn, $sql);
        // Put the data into the database
        $sql = "UPDATE timeGeneral SET time_end = '$end_unix' WHERE time_id = '$time_id';";
        // Execute the sql
        $result = mysqli_query($conn, $sql);
        // Put the data into the database
        $sql = "UPDATE timeGeneral SET date = '$date' WHERE time_id = '$time_id';";
        // Execute the sql
        $result = mysqli_query($conn, $sql);
        // Put the data into the database
        $sql = "UPDATE timeGeneral SET time = '$time' WHERE time_id = '$time_id';";
        // Execute the sql
        $result = mysqli_query($conn, $sql);
        // Put the data into the database
        $sql = "UPDATE timeGeneral SET des = '$description' WHERE time_id = '$time_id';";
        // Execute the sql
        $result = mysqli_query($conn, $sql);
    } else {
        // Send them to the home page
        header("Location: ./index.php");        
    }