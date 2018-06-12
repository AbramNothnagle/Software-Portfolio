<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>View Employees</h2>
        <?php

        include 'includes/dbh.inc.php';
        $org_name = $_SESSION['u_org_name'];
        $sql = "SELECT * FROM employees";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['emp_org_name']===$org_name){
            
                echo "<div id='projectBox' style='width: 950px; height:35px;
                padding: 5px;
                margin-bottom:4px;
                background-color: #fff;
                border-radius: 4px;font-size:14px;'>
                <p>";
                echo "First Name: ";
                echo $row['emp_first'];
                echo " | Last Name: ";
                echo $row['emp_last'];
                echo " | Email: ";
                echo $row['emp_email'];               
               
                echo "</p></div>";
                
                echo "<form style='position:absolute; margin-top:-65px; margin-left: 60%;' method='POST' action='employeeEntries.php'>
                <input type='hidden' name='emp_id' value='".$row['emp_id']."'>
                <input type='hidden' name='emp_first' value='".$row['emp_first']."'>
                <input type='hidden' name='emp_last' value='".$row['emp_last']."'>
                <input type='hidden' name='project_id' value='".$row['user_id']."'>
                <input type='hidden' name='project_name' value='".$row['project_name']."'>
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
            
            }
        }


        ?>

    </div>
</section>

<?php
    include_once 'footer.php';
?>



