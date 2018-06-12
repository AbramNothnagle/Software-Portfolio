<?php

function getProject($conn){
    
        $org_name = $_SESSION['e_org_name'];
        $sql = "SELECT * FROM work";
        $result = mysqli_query($conn, $sql);
    
        while ($row = $result->fetch_assoc()) {
            if ($row['org_name']===$org_name){
            echo "<div style='width: 950px; height:30px;
            margin-left: -38%;
            padding: 20px;
            margin-bottom:4px;
            background-color: #fff;
            border-radius: 4px; font-size:14px;'>
            <p>";
            echo " Project Name: ";
            echo $row['project_name'];
            echo " | Hours in project: ";
            echo $row['hours'];
            echo " | Date: ";
            echo $row['date'];
            echo "</p></div>";
            echo "<form style='position:absolute; margin-top:-6%; margin-left: 40%;' method='POST' action='submitHours.php'>
            <input type='hidden' name='project_id' value='".$row['user_id']."'>
            <input type='hidden' name='project_name' value='".$row['project_name']."'>
            <button type ='submit' name='submitHours' style=' width: 180px;
            height: 30px;
            margin-right: 10px;
            border: none;
            background-color: #f3f3f3;
            font-family: arial;
            font-size: 16px;
            color: #111;
            cursor: pointer;'>
            Select Project</button></form>";
    }
}
}
