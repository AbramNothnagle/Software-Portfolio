<?php
    // Start a session
    session_start();
    // Check to make sure a proper submission was done
    if (isset($_POST['job_code'])) {
        // Connect to the database
        include 'includes/dbh.inc.php';
        // Get the entered job code
        $job_code = $_POST['job_code'];
        // Get the company id 
        $org_id = $_SESSION['e_org_id'];
         // Find the project with that job code if it exists
        $sql = "SELECT * FROM projects WHERE job_code = '$job_code' AND org_id = '$org_id' AND status = 'active';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Get the number of results
        $result_check = mysqli_num_rows($result);
        // Send back result
        if ($result_check > 0) {
            // Go through result
            while ($row = $result->fetch_assoc()) {
                // Get the project name 
                $project_name = $row['project_name'];
            }
            // Fill the array
            $data[] = array(
                // Get number of results
                'number' => $result_check, 
                // Get project name
                'project_name' => $project_name
            );
            // Send back data
            echo json_encode($data);
        } else {
            // Fill the array
            $data[] = array(
                // Get number of results
                'number' => $result_check
            );
            // Send back data
            echo json_encode($data);
        }


    } else {
        // Send them back to home page
        header("Location: ./index.php");
    }