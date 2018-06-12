<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

if(isset($_POST["title"]))
{

$date1 = $_POST['date1'];
$start_event = $date1 + ' 00:00:00';
$end_start = $date1 + ' 24:00:00';

$query = "
INSERT INTO events 
(title, start_event, end_event, emp_id, location, project, description) 
VALUES (:title, $start_event, $end_event, :emp_id, :location, :project, :description)
";
$statement = $connect->prepare($query);
$statement->execute(
    array(
        ':title'  => $_POST['title'],
        ':emp_id' => $_POST['emp_id'],
        ':location' => $_POST['location'],
        ':project' => $_POST['project'],
        ':description' => $_POST['description']
        )
    );
}


?>