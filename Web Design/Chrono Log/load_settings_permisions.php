<?php
    // Start session
    session_start();
    // Creates database connection
    include 'includes/dbh.inc.php';
    // Get the current id
    $org_id = $_SESSION['u_org_id'];
    // Get all the sumbitted entries of the employee
    $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id';";
    // Put the result into $result
    $result = mysqli_query($conn, $sql);
    
    // Go through the results 
    while ($row = $result->fetch_assoc()) {
        $employee_allow_edit = array();
        $employee_allow_edit[0] = $row['allow_employee_time_edit'];
        $employee_allow_edit[1] = $row['allow_manager_time_edit'];
    }

    echo json_encode($employee_allow_edit);