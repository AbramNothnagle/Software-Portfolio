<?php

function setProject($conn){
    if(isset($_POST['commentSubmit'])){
        $uid = mysqli_real_escape_string($conn, $_SESSION['user_id']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $projectName = mysqli_real_escape_string($conn, $_POST['projectName']);
        $hours = mysqli_real_escape_string($conn, $_POST['hours']);
        $org_name = mysqli_real_escape_string($conn, $_SESSION['u_org_name']);

        $sql = "INSERT INTO projects (uid, hours, date, project_name, org_name) VALUES ('$uid','$hours','$date','$projectName','$org_name')";
        $result = mysqli_query($conn, $sql);
    }
}
function getProject($conn){
    
        echo '<link rel="stylesheet" type="text/css" href="style_now.css">';

        $org_name = $_SESSION['u_org_name'];
        $sql = "SELECT * FROM projects";
        $result = mysqli_query($conn, $sql);
        
        echo "<div id='list'>";
        while ($row = $result->fetch_assoc()) {
            if ($row['org_name']===$org_name){           
            
            
            $_SESSION['projects_opened']="done";
            // Creating the project box
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
            echo "<form style='float:right; margin-top:0px;' method='POST' action='editProject.php'>
                <input type='hidden' name='project_id' value='".$row['user_id']."'>
                <input type='hidden' name='project_name' value='".$row['project_name']."'>
                <input type='hidden' name='date' value='".$row['date']."'>
                <button class='box-button' type ='submit' name='editproject'>
                Edit</button></form>"; 
            echo "</div>";
            echo "</div>";
            
        }
        echo "</div>";
    }
}
