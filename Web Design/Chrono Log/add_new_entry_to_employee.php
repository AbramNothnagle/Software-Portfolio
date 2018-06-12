<?php 

    // Start a session
    session_start();
    // Connect to database
    include 'includes/dbh.inc.php';
    // Get the current company
    $org_id = $_SESSION['u_org_id'];
    // Get the selected employee id
    $project_id = $_POST['project_id'];
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

    // Get time length of the entry in minutes, this is total minutes
    $time = ($end_unix - $start_unix)/60;
    // Get time length of the entry in hours, this is total hours
    $hours = floor($time/60);
    // Get time minutes part of the time entry, not the same thing as total minutes
    $minutes = $time - ($hours * 60);
    // Add a 0 on the hours part if it is less than 10 hours
    if ($hours < 10){
        // Create an hours string with a 0
        $hours = "0".$hours;
    }
    // Add a 0 on to the minutes part if it is less than 10 minutes
    if ($minutes < 10){
        // Create an minutes string with a 0
        $minutes = "0".$minutes;
    }
    // Put the hours and minutes together in a string
    $time = $hours.":".$minutes.":"."00";
    // Put the data into the database
    $sql = "INSERT INTO timeGeneral (emp_id, project_id, des, submitted, time_start, time_end, emp_org_id, date, time,status) VALUES ('$emp_id', '$project_id','$description','yes', '$start_unix','$end_unix','$org_id','$date','$time','active');";
    // Execute the sql
    $result = mysqli_query($conn, $sql);


    