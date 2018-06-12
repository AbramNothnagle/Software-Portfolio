<?php

//update_submit.php

$connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');

if(isset($_POST["id"]))
{
 $query = "
 UPDATE events 
 SET title=:title, location=:location, description=:description, project_id=:project_id, emp_id=:emp_id
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
        ':emp_id' => $_POST['emp_id']
        )
    );
}

?>
