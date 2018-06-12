<?php  
    // Start a session
    session_start();
    // Check to make sure a proper submit was done
    if ($_SESSION['project_id']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $pid = $_SESSION['project_id'];
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Get all of the project entries
        $sql = "SELECT * FROM timeGeneral WHERE project_id = '$pid' AND emp_org_id = '$org_id' AND status = 'active';";
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
            // Get the employee id
            $emp_id = $row['emp_id'];
            // Get all of the project entries
            $sql = "SELECT * FROM employees WHERE emp_id = '$emp_id';";
            // Prepare the statement
            $statement = $conn->prepare($sql);
            // Run the SQL code
            $statement->execute();
            // Put the result into $result
            $result2 = $statement->fetchAll();
            // Get the start time of the entry
            $start_time = $row['time_start'];
            // Get the end time of the entry
            $end_time = $row['time_end'];
            // Go through the results
            foreach($result2 as $row2) {
                // Get the first name
                $first = $row2['emp_first'];
                //Get the last name
                $last = $row2['emp_last'];
            }
            if ( $row['des'] != null ) {
                // Get the description
                $description = $row['des'];
            } else {
                // Set description to an empty string
                $description = 'none';
            }
            // Fill the array
            $data[] = array(
                // Get the entry id
                'id' => $row['time_id'], 
                // Get the employee first name
                'first' => $first,
                // Get the employee last name
                'last' => $last,
                // Get the employee length 
                'time' => $row["time"],
                // Get the employee date
                'date' => $row['date'],
                // Get the description
                'description' => $description,
                // Format the start time to a 12 hour clock hour and mintues
                'start' => date("g:i",$start_time),
                // Get the AM/PM of the start time
                'startdiem' => date("A",$start_time),
                // Format the end time to a 12 hour clock hour and mintues
                'end' => date("g:i",$end_time),
                // Get the AM/PM of the end time
                'enddiem' => date("A",$end_time)
            );
        }
        // return events in json
        echo json_encode($data);
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }