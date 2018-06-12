<?php

// Creates database connection
include 'includes/dbh.inc.php';
// Check to make sure a proper submission is made
if (isset($_POST['delete_set'])){
    // Get the array of entries selected to delete
    $box = $_POST['arr'];
    // Go throught the list of selected entries
    while (list ($key, $val) = @each ($box)){ 
        // Set the entry status to deleted
        mysqli_query($conn, "UPDATE timeGeneral SET status = 'deleted' WHERE time_id = '$val';");
    } 
}