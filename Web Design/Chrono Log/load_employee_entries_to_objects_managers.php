<?php  
    // Start a session
    session_start();
    // Check to make sure a proper submit was done
    if ($_POST['emp_load']) {
        // Make a database connection
        $conn = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // put the session project_id into $pid
        $eid = $_SESSION['current_emp_id'];
        // Get the company id
        $org_id = $_SESSION['m_org_id'];
        // Get all of the project entries
        $sql = "SELECT * FROM timeGeneral WHERE emp_id = '$eid' AND emp_org_id = '$org_id' AND status = 'active';";
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
            $project_id = $row['project_id'];
            // Get all of the project entries
            $sql = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id ='$org_id';";
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
                // Get the project name
                $project_name = $row2['project_name'];
            }
            if ( $row['des'] != null ) {
                // Get the description
                $description = $row['des'];
            } else {
                // Set description to an empty string
                $description = '';
            }
            // Fill the array
            $data[] = array(
                // Get the entry id
                'id' => $row['time_id'], 
                // Get the project name
                'project_name' => $project_name,
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