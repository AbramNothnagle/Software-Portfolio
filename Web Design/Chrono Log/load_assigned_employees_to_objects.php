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
            $emp_id = $row['emp_id'];
            // Check if there is a project in this row
            if ($emp_id != '') {
                // Get all of the project entries
                $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status = 'active' AND emp_id = '$emp_id';";
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
                        // Get the employee id
                        'id' => $row2['emp_id'], 
                        // Get the employee first name
                        'first' => $row2['emp_first'],
                        // Get the employee last name
                        'last' => $row2['emp_last'],
                        // Get the employee email
                        'email' => $row2['emp_email']

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