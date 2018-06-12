<?php
    // Start session
    session_start();
    // Make sure a search was done and an admin is signed in
    if (isset($_GET['search']) && isset($_SESSION['u_org_id'])) {
        //include database configuration file
        include 'includes/dbh.inc.php';
        // Get the company name
        $org_id = $_SESSION['u_org_id'];
        //Get the search
        $search = $_GET['search'];
        // Get records from database
        $sql = "SELECT * FROM employees WHERE emp_email LIKE '%{$search}%' AND emp_org = '$org_id'";
        // Put the results into $result
        $result = mysqli_query($conn, $sql);
        // Check how many results there were
        $resultCheck = mysqli_num_rows($result);
        // If there is more than 0 results, execute code
        if($resultCheck > 0){
            
            $delimiter = ",";
            $filename = "employees_" . date('Y-m-d') . ".csv";
            
            
            //create a file pointer
            $f = fopen('php://memory', 'w');
            
            
            //set column headers
            $fields = array('ID', 'First Name', 'Last Name', 'E-mail');
            fputcsv($f, $fields, $delimiter);
            
            //output each row of the data, format line as csv and write to file pointer
            while($row = $result->fetch_assoc()){
                
                $lineData = array($row['emp_id'], $row['emp_first'], $row['emp_last'], $row['emp_email']);
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