<?php

    echo "<div style='display:none; margin-top:-44px; font-size:20px; height:44px;'>Employee Found</div>";
    // Create the box where the info is displayed
    echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
    
    echo "<div id='projectBox' style='width: 97%; height:50px;
    margin:0 auto;
    background-color: rgb(144, 223, 255);
    border-radius: 4px;font-size:16px;'>
        <p>";
    
    echo "<div style='float:left;margin-left:12px;'>";
    // Display the manager's info
    echo "First Name: ";
    echo $row['manager_first'];
    echo " | Last Name: ";
    echo $row['manager_last'];
    echo " | Email: ";
    echo $row['manager_email'];   
    
    echo "</div>";
    echo "</p></div>";
    
    // Create a button to select a manager
    echo "<form style='position:relative; margin-top:-60px; float:right; margin-right:26px;' method='POST' action='select_manager.php'>
        <input type='hidden' name='manager_id' value='".$row['manager_id']."'>
        <input type='hidden' name='manager_first' value='".$row['manager_first']."'>
        <input type='hidden' name='manager_last' value='".$row['manager_last']."'>
        <button type ='submit' name='view_manager' style=' width: 180px;
        height: 30px;
        margin-right: 10px;
        border: none;
        background-color: #f3f3f3;
        font-family: arial;
        font-size: 16px;
        color: #111;
        cursor: pointer;'>
        Select Manager</button></form>";
    echo "</div>";