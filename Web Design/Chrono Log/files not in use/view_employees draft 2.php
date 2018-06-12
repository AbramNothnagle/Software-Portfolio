<?php
    include_once 'header.php';
    include 'includes/dbh.inc.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='float:left; font-size:20px; line-height:40px;'>Manage Employees</h1>
            </div>
        </div>
        <div class='box-create' style='width:100%; height:120px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                
                
                <form id='search-form' method='POST' action=<?php search_employee($conn); ?>>
                    
                    <button type='submit' name='employee' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                    font-size: 16px;' >Search</button>
                    <input placeholder='Search employees'type='text' name='employee_email' style='padding: 0px 0px 0px 12px;float:right;width:30%;height:37px;margin-top:20px; margin-right:20px; font-size:16px;'>

                </form>
                
            </div>
        </div>
        <?php

        $org_name = $_SESSION['u_org_name'];
        $sql = "SELECT * FROM employees";
        $result = mysqli_query($conn, $sql);
        
        if (!isset($_POST['employee'])) {
            while ($row = $result->fetch_assoc()) {
                if ($row['emp_org_name']===$org_name){
                

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
                    
                    echo "<form style='position:absolute; margin-top:-62px; margin-left: 56%;' method='POST' action='employeeEntries.php'>
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
                    echo "</div>";
                }
            }
        }


        function search_employee($conn) {

            if (!isset($_POST['employee'])) {
                
                
                $org_name = $_SESSION['u_org_name'];
                $employee = $_POST['employee_email'];

                $sql2 = "SELECT * FROM employees WHERE emp_org_name = '$org_name' AND emp_email = '$employee';";
                $result2 = mysqli_query($conn, $sql2);
                $resultCheck = mysqli_num_rows($result2);
 
                echo "<br><br><br><br><br><br><br><br>";
                if ($resultCheck < 1) {
                    echo "here";
                    
                } else {
                    
                    while ($row = $result2->fetch_assoc()) {
                        
                        // echo "Employee Found";
                        // echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
                        // echo "<div id='projectBox2' style='width: 97%; height:50px;
                        // margin:0 auto;
                        // background-color: rgb(144, 223, 255);
                        // border-radius: 4px;font-size:16px;'>
                        //     <p>";
                        // echo "<div style='float:left;margin-left:12px;' >";
                        // echo "First Name: ";
                        // echo $row['emp_first'];
                        // echo " | Last Name: ";
                        // echo $row['emp_last'];
                        // echo " | Email: ";
                        // echo $row['emp_email']; 
                        // echo "</div>";              
                    
                        // echo "</p></div>";
                        
                        // echo "<form style='position:absolute; margin-top:-62px; margin-left: 56%;' method='POST' action='employeeEntries.php'>
                        //     <input type='hidden' name='emp_id' value='".$row['emp_id']."'>
                        //     <input type='hidden' name='emp_first' value='".$row['emp_first']."'>
                        //     <input type='hidden' name='emp_last' value='".$row['emp_last']."'>
                        //     <input type='hidden' name='project_id' value='".$row['user_id']."'>
                        //     <input type='hidden' name='project_name' value='".$row['project_name']."'>
                        //     <button type ='submit' name='viewemployee' style=' width: 180px;
                        //     height: 30px;
                        //     margin-right: 10px;
                        //     border: none;
                        //     background-color: #f3f3f3;
                        //     font-family: arial;
                        //     font-size: 16px;
                        //     color: #111;
                        //     cursor: pointer;'>
                        //     Select Employee</button></form>";
                        // echo "</div>";
                    }
                }
            }
        }

        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>



