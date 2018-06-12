<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['u_id']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Get all of the project entries
        $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' and status = 'active';";
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
                // Get the manager id
                'id' => $row['emp_id'], 
                // Get the manager's first name
                'first' => $row['emp_first'],
                // Get the manager's last name
                'last' => $row['emp_last'],
                // Get the project name
                'email' => $row['emp_email']
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }