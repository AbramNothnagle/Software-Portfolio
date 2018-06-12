<?php
//include database configuration file
include 'includes/dbh.inc.php';

session_start();


// Get the project name
$project = $_SESSION['project_id'];
$project_name = $_SESSION['project_name'];

//get records from database
$sql = "SELECT * FROM time WHERE p_id='$project'";

$result = mysqli_query($conn, $sql);

$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0){
    
    $delimiter = ",";
    $filename = "projects_" . date('Y-m-d') . ".csv";
    
     
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    
    
    //set column headers
    $fields = array('ID', 'Project_name','Employee First', 'Employee Last', 'Hours' , 'Description','Date');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $result->fetch_assoc()){
        
        $lineData = array($row['time_id'], $project_name, $row['emp_first'], $row['emp_last'], $row['hours'], $row['des'],$row['date']);
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
exit;

?>