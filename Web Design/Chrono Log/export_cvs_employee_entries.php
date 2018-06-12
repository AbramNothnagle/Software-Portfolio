<?php
// Start a session
session_start();
    // Make sure an employee is chosen and an admin is signed in
    if (isset($_SESSION['current_emp_id']) && isset($_SESSION['u_org_id'])) {
        //include database configuration file
        include 'includes/dbh.inc.php';
        // Get the employee id
        $emp_id = $_SESSION['current_emp_id'];
        //get records from database
        $sql = "SELECT * FROM timeGeneral WHERE emp_id='$emp_id'";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Get the number of results
        $resultCheck = mysqli_num_rows($result);
        // Check if there is 1 or more results
        if($resultCheck > 0) {
            
            $delimiter = ",";
            $filename = "employee_" . date('Y-m-d') . ".csv";
            
            
            //create a file pointer
            $f = fopen('php://memory', 'w');
            
            
            
            //set column headers
            $fields = array('ID', 'Employee First', 'Employee Last', 'Hours' , 'Date');
            fputcsv($f, $fields, $delimiter);
            
            //output each row of the data, format line as csv and write to file pointer
            while($row = $result->fetch_assoc()){
                
                $lineData = array($row['time_id'], $row['emp_first'], $row['emp_last'], $row['hoursTotal'], $row['date']);
                fputcsv($f, $lineData, $delimiter);
            }
            
            
            //move back to beginning of file
            fseek($f, 0);
            
            //set headers to download file rather than displayed
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            
            //output all remaining data on a file pointer
            fpassthru($f);

        }
        // Leave the php code
        exit;
        
    } else {
        // Send them to the home page
        header("Location: ./index.php");
    }

