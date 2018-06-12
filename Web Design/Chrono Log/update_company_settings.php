<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_POST['employee_allow_edit']) && isset($_POST['manager_allow_edit'])) {
        // Connect to the database
        $connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // Update the company settings in the database
        $query = "
            UPDATE company_info_and_settings
            SET allow_employee_time_edit=:allow_employee_time_edit, allow_manager_time_edit=:allow_manager_time_edit
            WHERE org_id=:id
            ";
        // Prepare the statement
        $statement = $connect->prepare($query);
        // Run the php
        $statement->execute(
        // Put the settings in an array
        array(
            ':allow_employee_time_edit' => $_POST['employee_allow_edit'],
            ':allow_manager_time_edit' => $_POST['manager_allow_edit'],
            ':id'   => $_SESSION['u_org_id']
            )
        );
        
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }