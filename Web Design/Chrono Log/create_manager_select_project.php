<?php  
    // Get the company name 
    $org_id = $_SESSION['m_org_id'];
    // Get the manager id
    $manager_id = $_SESSION['m_id'];
    // Get all the managers from that company
    $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
    // Put the result into $result
    $result = mysqli_query($conn, $sql);
    // Put each employee into an option 
    while ($row = $result->fetch_assoc()) {
        // Check if the project_id is not null
        if ($row['project_id'] != null) {
            // Get the employee's id
            $project_id = $row['project_id'];
            // Get all the managers from that company
            $sql = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id = '$org_id';";
            // Put the result into $result
            $result2 = mysqli_query($conn, $sql);
            // Go through the results
            while ($row2 = $result2->fetch_assoc()) {
                // Get the employee's email
                $project_name = $row2['project_name'];
                // Put the employee in an option
                echo "<option value='$project_id'>$project_name</option>";
            }
        }
    }