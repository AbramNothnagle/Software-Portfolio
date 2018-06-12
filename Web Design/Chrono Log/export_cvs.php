<?php
//include database configuration file
include 'includes/dbh.inc.php';
// Start a session
session_start();
// Get the company name
$org_id = $_SESSION['u_org_id'];
//get records from database
$sql = "SELECT * FROM projects WHERE org_id='$org_id'";
// Put the results into $result
$result = mysqli_query($conn, $sql);
// Check how many results there are
$resultCheck = mysqli_num_rows($result);
// If there is more than 0 results, execute code
if($resultCheck > 0){
    
    $delimiter = ",";
    $filename = "projects_" . date('Y-m-d') . ".csv";
    
     
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    
    
    //set column headers
    $fields = array('ID', 'Project Name', 'Description', 'Date', 'Hours');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $result->fetch_assoc()){
        
        $lineData = array($row['project_id'], $row['project_name'], $row['description'], $row['date'], $row['hours']);
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