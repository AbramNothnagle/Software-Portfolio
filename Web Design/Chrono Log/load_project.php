<?php

//load.php

session_start();

$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

$data = array();

$org_name = $_SESSION['u_org_name'];

$project_name = $_SESSION['load_project'];

$query = "SELECT * FROM events WHERE org_name = '$org_name' AND project = '$project_name';";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{

 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'description' => $row["description"],
  'dow' => $row["dow"],
  'location' => $row["location"],
  'project' => $row["project"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );

}
echo json_encode($data);

?>