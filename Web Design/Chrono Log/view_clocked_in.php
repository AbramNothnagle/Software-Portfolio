<?php
    // Include the header in the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // If not, exit the code
        exit;
    }
?>

<!-- Main part of page -->
<section class="main-container">
    
    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>
    
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4 >Currently Clocked In</h4>
            </div>
        </div>

        <div class='box-create' style='width:100%; height:120px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                

                <button id='employee-search' type='submit' name='employee' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                    font-size: 16px;' >Search
                </button>
                
                <input id='search-input' placeholder='Search employees'type='text' name='employee_email' style='padding: 0px 0px 0px 12px;float:right;width:30%;height:37px;margin-top:20px; margin-right:20px; font-size:16px;'>
  

                <button name='commentSubmit' 
                    style=' width: 150px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    margin-right:20px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    Filter
                </button>

                
                <select style='width: 150px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;'>
                    <option>Project</option>
                    <option>Position</option>
                </select>
        
            </div>
        </div>



        <!-- Start php code -->
        <?php

            // Connect to the database
            include 'includes/dbh.inc.php';
            // Get the company id
            $org_id = $_SESSION['u_org_id'];
            // Get all entries that haven't been submitted. The employee that put these in the database is still clocked in
            $sql = "SELECT * FROM timeGeneral WHERE emp_org= '$org_id' AND submitted = 'no';";
            // Put the result into $result
            $result = mysqli_query($conn, $sql);
            // Go through the results
            while ($row = $result->fetch_assoc()) {
                
                echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
                
                echo "<div id='projectBox' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'>
                    <p>";
                
                echo "<div style='float:left;margin-left:12px;'>";
                // Display the employee's info
                echo "First Name: ";
                echo $row['emp_first'];
                echo " | Last Name: ";
                echo $row['emp_last'];
                echo " | Email: ";
                echo $row['emp_email'];   
                
                echo "</div>";
                echo "</p></div>";
                
                // Create a button to select an employee
                echo "<form style='position:absolute; margin-top:-60px; margin-left: 56%;' method='GET' action='employee_entries.php'>
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
    

        ?>
        <!-- End php code -->


    </div>
</section>
<!-- End main part of page -->



