<?php

    // Start a session
    session_start();
    // Check to make sure employee is signed in or an employee is selected
    if (isset($_SESSION['e_id']) or isset($_SESSION['current_emp_id'])) {
        // Make a database connection
        $connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // create an empty array
        $data = array();
        // Check if employee is signed in
        if (isset($_SESSION['e_id'])) {
            // Get the employee id 
            $emp_id = $_SESSION['e_id'];
        } else {
            // Get the employee selected id
            $emp_id = $_SESSION['current_emp_id'];
        }

        // Create a statement to get all events of this employee
        $query = "SELECT * FROM events WHERE emp_id = $emp_id";
        // Prepare the statement
        $statement = $connect->prepare($query);
        // Run the sql code
        $statement->execute();
        // Put the result into $result
        $result = $statement->fetchAll();
        // Go through each row of the results. These will be events
        foreach($result as $row) {
            // Get the project id of the event
            $project_id = $row["project_id"];
            // Get the project with that id
            $query = "SELECT * FROM projects WHERE project_id = '$project_id'";
            // Prepare the statement
            $statement = $connect->prepare($query);
            // Run the SQL code
            $statement->execute();
            // Put the result into $result2
            $result2 = $statement->fetchAll();
            // Go through the results
            foreach($result2 as $row2) {   
                // Get that project's name
                $project_name = $row2['project_name'];
            }
            // Put the data into an the $data array
            $data[] = array(
                'id'   => $row["id"],
                'title'   => $row["title"],
                'description' => $row["description"],
                'location' => $row["location"],
                'project' => $project_name,
                'project_id' => $row["project_id"],
                'start'   => $row["start_event"],
                'end'   => $row["end_event"]
            );

        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

