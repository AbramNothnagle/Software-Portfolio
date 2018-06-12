<?php  
    // Start a session
    session_start();
    // Check to make sure an admin is signed in
    if ($_SESSION['m_id']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $org_id = $_SESSION['m_org_id'];
        // put the session project_id into $pid
        $m_id = $_SESSION['m_id'];
        // Get all of the project entries
        $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$m_id';";
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
            // Get the assigned project
            $project_id = $row['project_id'];
            // Check if there is a project in this row
            if ($project_id != '') {
                // Get all of the project entries
                $sql = "SELECT * FROM projects WHERE org_id = '$org_id' AND status = 'active' AND project_id = '$project_id';";
                // Prepare the statement
                $statement = $conn->prepare($sql);
                // Run the SQL code
                $statement->execute();
                // Put the result into $result
                $result2 = $statement->fetchAll();
                // Go through the results
                foreach($result2 as $row2) { 
                    // Fill the array
                    $data[] = array(
                        // Get the project id
                        'id' => $row2['project_id'], 
                        // Get the employee date
                        'date' => $row2['date'],
                        // Get the description
                        'description' => $row2['description'],
                        // Get the project name
                        'name' => $row2['project_name'],
                        // Get the job code
                        'job_code' => $row2['job_code']
                    );
                }
            }
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }