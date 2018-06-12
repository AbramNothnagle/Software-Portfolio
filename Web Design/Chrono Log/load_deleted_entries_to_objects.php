<?php  
    // Start a session
    session_start();
    // Check to make sure a proper submission is made
    if ($_POST['entries_deleted_load']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $org_id = $_SESSION['u_org_id'];
        // Get all of the project entries
        $sql = "SELECT * FROM timeGeneral WHERE emp_org_id = '$org_id' and status = 'deleted';";
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

            // Get the project that the entry is for
            $id = $row['project_id'];
            // Get the project info
            $sql = "SELECT * FROM projects WHERE project_id = '$id' AND org_id='$org_id';";
            // Prepare the statement
            $statement = $conn->prepare($sql);
            // Run the SQL code
            $statement->execute();
            // Put the result into $result2
            $result2 = $statement->fetchAll();
            // Go through the results
            foreach($result2 as $row2) { 
                // Get the project name
                $project_name = $row2['project_name'];
            }
            // Get the project that the entry is for
            $id = $row['emp_id'];
            // Get the project info
            $sql = "SELECT * FROM employees WHERE emp_id = '$id' AND emp_org ='$org_id';";
            // Prepare the statement
            $statement = $conn->prepare($sql);
            // Run the SQL code
            $statement->execute();
            // Put the result into $result2
            $result2 = $statement->fetchAll();
            // Go through the results
            foreach($result2 as $row2) { 
                // Get the employee's email
                $emp_email = $row2['emp_email'];
            }
            
            // Fill the array
            $data[] = array(
                // Get the project id
                'id' => $row['time_id'], 
                // Get the employee date
                'date' => $row['date'],
                // Get the length in time
                'time' => $row['time'],
                // Put in the project name
                'project_name' => $project_name,
                // Put im the employee's email
                'email' => $emp_email
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }