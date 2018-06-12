<?php

//load.php

// Start a session
session_start();
// Make a database connection
$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
// create an empty array
$data = array();
// Get the company's id
$org_id = $_SESSION['u_org_id'];





if ($_SESSION['project_filter'] == 'all') {
    $query = "SELECT * FROM events WHERE org_id = '$org_id';";
    //echo"here";
} else {
    $project_id = $_SESSION['project_filter'];
    $query = "SELECT * FROM events WHERE project_id = '$project_id';";
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row) {

    $emp_id = $row['emp_id'];
    
    $query = "SELECT emp_email FROM employees WHERE emp_id = '$emp_id';";

    $statement = $connect->prepare($query);
    
    $statement->execute();
    
    $result2 = $statement->fetchAll();

    foreach($result2 as $row2) {
        $emp_email = $row2['emp_email'];
    }

    $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'description' => $row["description"],
        'dow' => $row["dow"],
        'location' => $row["location"],
        'project_id' => $row["project_id"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"],
        'emp_id' => $row['emp_id'],
        'emp_email' => $emp_email
    );

}
echo json_encode($data);

?>