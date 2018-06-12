<?php
    // Start a session
    session_start()
    // Check to make sure a proper submission was made
    if(isset($_POST["emp_id"])){
        // Connect to the database
        $connect = new PDO('mysql:host=localhost;dbname=loginsystem', 'root', 'root');
        // Delete all events associated with the employee
        $query = "DELETE from events WHERE emp_id=:emp_id";
        // Prepare the statement
        $statement = $connect->prepare($query);
        // Run the SQL
        $statement->execute(
        // Put the employee id into an array
        array(
        ':emp_id' => $_POST['emp_id']
        )
        );
    } else {
        // Send them to the home page
        header("Location: ./index.php");        
    }

?>

