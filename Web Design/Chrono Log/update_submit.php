<?php

//update_submit.php

$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, location=:location, description=:description, project_id=:project_id, start_event=:start_event, end_event=:end_event
 WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':location' => $_POST['location'],
   ':description' => $_POST['description'],
   ':project_id' => $_POST['project_id'],
   ':id'   => $_POST['id'],   
   ':start_event' => $_POST['start'],
   ':end_event'   => $_POST['end']
  )
 );
}

?>
