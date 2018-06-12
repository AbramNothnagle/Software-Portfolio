<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_POST['managers_deleted_load']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Get all of the project entries
        $sql = "SELECT * FROM managers WHERE manager_org_id = '$org_id' and status = 'deleted';";
        // Prepare the statement
        $statement = $conn->prepare($sql);
        // Run the SQL code
        $statement->execute();
        // Put the result into $result
        $result = $statement->fetchAll();
        // create an empty array
        $data = array();
        // Go through the results
        foreach($result as $row) { 
            // Fill the array
            $data[] = array(
                // Get the project id
                'id' => $row['manager_id'], 
                // Get the employee's first name
                'first' => $row['manager_first'],
                // Get the employee's last name
                'last' => $row['manager_last'],
                // Get the employee's email
                'email' => $row['manager_email'],
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }