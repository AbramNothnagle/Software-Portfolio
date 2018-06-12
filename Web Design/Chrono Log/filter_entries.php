<?php

//load.php

session_start();

include 'includes/dbh.inc.php';

$project_name = $_POST['input'];

$emp_id = $_SESSION['current_emp_id'];

$org_name=$_SESSION['u_org_name'];

$sql = "SELECT * FROM timeGeneral WHERE org_name = '$org_name' AND emp_id = '$emp_id'";

$result = mysqli_query($conn, $sql);

$resultCheck = mysqli_num_rows($result);

if ($resultCheck < 1){
    echo "<div style='margin-top:-44px; font-size:20px;'>No Results Found</div>";
    exit();
}
while ($row = $result->fetch_assoc()) {
    
    echo "<div style='margin-top:-44px; font-size:20px; height:44px;'>Project Found</div>";
    echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
    echo "<div id='projectBox' style='width: 97%; height:50px;
        margin:0 auto;
        
        background-color: rgb(144, 223, 255);
        border-radius: 4px;font-size:16px;'>
        <p>";
    echo "<div style='float:left;margin-left:12px;'>";
    echo " Project Name: ";
    echo $row['project_name'];
    // echo " | Hours in project: ";
    // echo $row['hours']." | Date : ";
    // echo $row['date'];
    echo "</div>";
    $pid = $row['user_id'];
    echo "</p>";
    
    // Select Project Button
    echo "<form style='position:absolute; margin-left:55%;' method='POST' action='viewHours.php'>
        <input type='hidden' name='project_id' value='".$row['user_id']."'>
        <input type='hidden' name='project_name' value='".$row['project_name']."'>
        <button class='box-button' type ='submit' name='submitHours'>
        Select Project</button></form>";

    // Edit Project Button
    echo "
    <input type='hidden' name='project_id' value='".$row['user_id']."'>
    <input type='hidden' name='project_name' value='".$row['project_name']."'>
    <input type='hidden' name='date' value='".$row['date']."'>
    <div class='edit_button_after_search'>
    <button value='".$row['user_id']."' data-project='".$row['project_name']."' data-date='".$row['date']."' style='float:right; margin-top:11px;' id='edit_button' onclick='modal();' class='box-button' type ='submit' name='editproject'>
    <div>
    Edit</button>"; 
    echo "</div>";
    echo "</div>";
}


?>