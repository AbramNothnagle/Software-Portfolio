<?php

//load.php

session_start();

include 'includes/dbh.inc.php';

$emp_email = $_POST['input'];

$org_name=$_SESSION['u_org_name'];

$sql = "SELECT * FROM employees WHERE emp_email LIKE '%{$emp_email}%' AND emp_org_name = '$org_name'";

$result = mysqli_query($conn, $sql);

$resultCheck = mysqli_num_rows($result);

if ($resultCheck < 1){
    echo "<div style='margin-top:-44px; font-size:20px;'>No Results Found</div>";
    exit();
} else { 
    
    
    
    
    echo "<div style='margin-top:-44px; font-size:20px; height:44px;'>Employee Found</div>";
    while ($row = $result->fetch_assoc()) {
        
        
        echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
        echo "<div id='projectBox' style='width: 97%; height:50px;
        margin:0 auto;
        background-color: rgb(144, 223, 255);
        border-radius: 4px;font-size:16px;'>
            <p>";
        echo "<div style='float:left;margin-left:12px;'>";
        echo "First Name: ";
        echo $row['emp_first'];
        echo " | Last Name: ";
        echo $row['emp_last'];
        echo " | Email: ";
        echo $row['emp_email']; 
        echo "</div>";              

        echo "</p></div>";
        
        echo "<form style='position:relative; float:right; margin-right:20px; margin-top:-60px;' method='POST' action='employeeEntries.php'>
            <input type='hidden' name='emp_id' value='".$row['emp_id']."'>
            <input type='hidden' name='emp_first' value='".$row['emp_first']."'>
            <input type='hidden' name='emp_last' value='".$row['emp_last']."'>
            <button type ='submit' name='viewemployee' style=' width: 180px;
            height: 30px;
            margin-right: 10px;
            border: none;
            background-color: #f3f3f3;
            font-family: arial;
            font-size: 16px;
            color: #111;
            cursor: pointer;'>
            Select Employee</button></form>";
        echo "</div>";

    }
}


?>