<?php

    // Start a session
    session_start();
    // Check to make sure a proper submission was made
    if (isset($_SESSION['u_id'])) {
        // Connect to the database
        $connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // Update the company settings in the database
        $query = "
            UPDATE company_info_and_settings
            SET org_name=:org_name, org_website=:org_website
            WHERE org_id=:id
            ";
        // Prepare the statement
        $statement = $connect->prepare($query);
        // Run the php
        $statement->execute(
        // Put the settings in an array
        array(
            ':org_name' => $_POST['company_name'],
            ':org_website' => $_POST['company_website'],
            ':id'   => $_SESSION['u_org_id']
            )
        );
        
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }