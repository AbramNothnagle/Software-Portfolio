<?php 
    //$_SESSION['projects_opened']="done";
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
    $pid = $row['project_id'];
    echo "</p>";
    
    if (isset($_SESSION['u_id'])) {
        // Select Project Button
        echo "<form style='position:relative; margin-left:47%;' method='POST' action='viewHours.php'>
            <input type='hidden' name='project_id' value='".$row['project_id']."'>
            <input type='hidden' name='project_name' value='".$row['project_name']."'>
            <button style='float:right; margin-top:11px;' class='box-button2' type ='submit' name='submitHours'>
            Select Project</button></form>";
        // Edit Project Button
        echo "
            <input type='hidden' name='project_id' value='".$row['project_id']."'>
            <input type='hidden' name='project_name' value='".$row['project_name']."'>
            <input type='hidden' name='date' value='".$row['date']."'>
            <button value='".$row['project_id']."' data-description='".$row['description']."' data-project='".$row['project_name']."' data-date='".$row['date']."' style='float:right; margin-top:11px;' id='edit_button' class='box-button' type ='submit' name='editproject'>
            Edit</button>"; 
    } elseif (isset($_SESSION['m_id'])) {
        // Select Project Button
        echo "<form style='position:relative; margin-left:47%;' method='POST' action='view_hours_for_managers.php'>
        <input type='hidden' name='project_id' value='".$row['project_id']."'>
        <input type='hidden' name='project_name' value='".$row['project_name']."'>
        <button style='float:right; margin-top:11px;' class='box-button2' type ='submit' name='submitHours'>
        Select Project</button></form>";

    }
    echo "</div>";
    echo "</div>";