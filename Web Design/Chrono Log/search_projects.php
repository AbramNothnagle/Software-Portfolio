<?php

//load.php

session_start();

include 'includes/dbh.inc.php';

$project_name = $_POST['input'];

$org_name=$_SESSION['u_org_name'];

$sql = "SELECT * FROM projects WHERE project_name LIKE '%{$project_name}%' AND org_name = '$org_name'";

$result = mysqli_query($conn, $sql);

$resultCheck = mysqli_num_rows($result);

if ($resultCheck < 1){
    echo "<div style='margin-top:-44px; font-size:20px;'>No Results Found</div>";
    exit();
} else {






    echo "<div style='margin-top:-44px; font-size:20px; height:44px;'>Project Found</div>";
    while ($row = $result->fetch_assoc()) {
        
        
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
        echo "<form style='position:absolute; margin-left:47%;' method='POST' action='viewHours.php'>
            <input type='hidden' name='project_id' value='".$row['user_id']."'>
            <input type='hidden' name='project_name' value='".$row['project_name']."'>
            <button class='box-button' type ='submit' name='submitHours'>
            Select Project</button></form>";

        // Edit Project Button
        echo "<button value='".$row['user_id']."' data-project='".$row['project_name']."' data-date='".$row['date']."' style='float:right; margin-top:11px;' id='edit_button' class='box-button' name='editproject'>
        Edit</button>";
        echo "</div>"; 
        echo "</div>";
        echo "</div>";
    }
}

?>