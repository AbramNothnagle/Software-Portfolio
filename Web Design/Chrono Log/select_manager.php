<?php
    // Put header in page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // if not, exit the code
        exit;
    }
    // If the view manager button was pressed, do this
    if (isset($_POST['view_manager'])) {
        // Set a session variable for the selected manager id
        $_SESSION['current_manager_id'] = $_POST['manager_id'];
        // Set a session variable for the selected manager first name
        $_SESSION['current_manager_first'] = $_POST['manager_first'];
        // Set a session variable for the selected manager last name
        $_SESSION['current_manager_last'] = $_POST['manager_last'];
    }
    // put the sessions current_manager_id into $manager_id
    $manager_id = $_SESSION['current_manager_id'];

?>

<!-- Put style_now stylesheet on page -->
<link rel="stylesheet" type="text/css" href="style_now.css">

<!-- Main part of page -->
<section class="main-container">
    
    <?php
        // Include the navigation in the page
        include_once 'nav.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>
       
        <!-- Creates the top of the form where the managers's name is displayed -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4><?php echo $_SESSION['current_manager_first'] . ' ' . $_SESSION['current_manager_last']; ?></h4>
                <button id='delete_manager' class='delete_button_can'>D</button>
            </div>
        </div>


        <!-- Top row 60px tall: has 2 buttons and 2 drop downs-->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>

                <!-- Form for assigning projects to a manager -->
                <form action='assign_project.php' method='POST'>
                <!-- Creates the drop down menu to select the project -->
                    <select class='dropdown-style-1' style='float:left;'name='project_id'> 
                        <?php

                            // Get the current company name
                            $org_id = $_SESSION['u_org_id'];
                            // Gets all projects from the database
                            $sql = "SELECT * FROM projects WHERE org_id = '$org_id' AND status = 'active';";
                            // Put the result in $result
                            $result = mysqli_query($conn, $sql); 
                            // Go through each project
                            while ($row = $result->fetch_assoc()) {
                                // Get the project's name       
                                $project = $row['project_name'];
                                // Get the project's id
                                $project_id = $row['project_id'];
                                // Put out the project as an option
                                echo "<option value='$project_id'>$project</option>";   
                                
                            }
                        ?>
                    </select>     
                    <!-- button to assign the selected project to a manager -->
                    <button class='button-style-1' style='width: 150px;' type='submit'>
                        ADD
                    </button>
                </form>
                <!-- Form project assign end  -->

                <!-- Form for de-assigning projects to a manager  -->
                <form action='deassign_project.php' method='POST'>
                    <!-- Creates the drop down menu to select the project -->
                    <select class='dropdown-style-1' style='float:right;' name='project'>      
    
                        <?php

                            // Gets all assignments from the database
                            $sql = "SELECT * FROM assignment_managers;";
                            // Put the result into $result2
                            $result2 = mysqli_query($conn, $sql); 

                            while ($row = $result2->fetch_assoc()) {
                                if ($row['manager_id']===$manager_id){
                                    if ($row['project_id'] != null) {
                                        // Get the project id
                                        $project_id = $row['project_id'];
                                        // Get the project with this project id
                                        $sql2 = "SELECT * FROM projects WHERE project_id = '$project_id';";
                                        // put result in result3
                                        $result3 = mysqli_query($conn, $sql2); 
                                        while ($row2 = $result3->fetch_assoc()) {
                                            // Get the project's name
                                            $project = $row2['project_name'];
                                            // create the option with the project's name
                                            echo "<option value='$project_id'>$project</option>";       
                                        }
                                    }
                                }
                            }
                        ?>
                    
                    </select>
                    <!-- button to remove selected project from manager -->
                    <button class='button-style-1' style='width: 150px;float:right; margin-right:20px;' type='submit'>
                        REMOVE
                    </button>
                </form>
                <!-- Form project de-assign end  -->
                 
            </div>
        </div>
        <!-- End top or 1st row -->

        <!-- 2nd row 60px tall: has 2 buttons and 2 drop downs-->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                <!-- Form for assigning employees to a manager -->
                <form action='assign_employee.php' method='POST'>
                    <!-- Creates the drop down menu to select the project -->
                    <select class='dropdown-style-1' style='float:left;' name='emp_id'>        
                    
                    <?php
                        // Gets all employees from the database
                        $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status='active';";
                        // Put the result in $result2
                        $result2 = mysqli_query($conn, $sql); 
                        // Go through all employees
                        while ($row = $result2->fetch_assoc()) {
                            // Get the employee's login name
                            $employee = $row['emp_uid'];
                            // Get the employee's id
                            $emp_id = $row['emp_id'];
                            // Get the employee's email
                            $emp_email = $row['emp_email'];
                            // Add the employee to an option
                            echo "<option value='$emp_id'>$employee email: $emp_email</option>";
                            
                        }
                    ?>

                    </select>
                    <!-- button to add selected employee to manager -->
                    <button class='button-style-1' style='width: 150px;' type='submit'>
                        ADD
                    </button>
                </form>
                <!-- Form employee assign end  -->  
            


                <!-- Form for de-assigning employees to a manager -->
                <form action='deassign_employee.php' method='POST'>
                    <!-- Creates the drop down menu to select the project -->
                    <select class='dropdown-style-1' style='float:right;' name='emp_id'>       
                        
                        <?php 
                            // Get all from assignment_managers
                            $sql = "SELECT * FROM assignment_managers;";
                            // Put the result in $result2
                            $result2 = mysqli_query($conn, $sql); 
                            // Go through the rows of the result
                            while ($row = $result2->fetch_assoc()) {
                                // Check if the manager id row match's the manager id
                                if ($row['manager_id']===$manager_id){
                                    // Check if the emp id row is null
                                    if ($row['emp_id'] != null) {                                       
                                        // Get the emp id
                                        $emp_id = $row['emp_id'];
                                        // Get the employee that has that id
                                        $sql2 = "SELECT * FROM employees WHERE emp_id = '$emp_id';";
                                        // Put the result in $result3
                                        $result3 = mysqli_query($conn, $sql2); 
                                        while ($row2 = $result3->fetch_assoc()) {
                                            // Get the employee's user login
                                            $emp_uid = $row2['emp_uid'];
                                            // Get the employee's email
                                            $emp_email = $row2['emp_email'];
                                            // Put the employee into an option
                                            echo "<option value='$emp_id'>$emp_uid email: $emp_email</option>";                                          
                                        }
                                    }
                                }
                            }

                        ?>

                    </select>
                    <!-- button to remove selected employee from manager -->
                    <button class='button-style-1' style='width: 150px;float:right;margin-right:20px;' type='submit'>
                        REMOVE
                    </button>
                </form>
                <!-- Form employee de-assign end  -->
            </div>
        </div>
        <!-- End 2nd row -->



        <!-- Blank area 20px -->
        <div class='box-create' style='width:100%; height:20px; background-color:rgb(247, 247, 247);'>
            <div id='top-bar' style='margin-left:20px;'>
            </div> 
        </div>

        <!-- 3rd row: 1 heading, says that assigned projects are under it-->
        <div class='box-create' style=' margin-top:-20px; width:100%; height:40px;  background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='font-size:20px; line-height:40px;'>Assigned Projects</h1>
            </div>
        </div>


        <?php
            // Creates database connection
            include 'includes/dbh.inc.php';
            // Get all from assigbment_managers where the manager id is the current manager's id
            $sql = "SELECT * FROM assignment_managers WHERE manager_id ='$manager_id'";
            // put the result in $result
            $result = mysqli_query($conn, $sql);
            // Creates the lines of projects that are assigned to the manager
            while ($row = $result->fetch_assoc()) {
                // If the project id is set, do this
                if ($row['project_id'] != null) {         
                    // Creating the project box
                    echo "  <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
                                <div id='projectBox' style='width: 97%; height:50px;
                                    margin:0 auto;
                                    background-color: rgb(144, 223, 255);
                                    border-radius: 4px;font-size:16px;'>
                                    <div style='float:left;margin-left:12px;'>
                                        ID: ".$row['project_id']." | Project Name: ".$row['project_name']."
                                    </div>
                                </div>
                            </div>";
                }
            }
        ?>

        <!-- Area for the button to add more projects to the manager -->
        <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
            <div id='assign_project_box' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;cursor:pointer;'>
                
                <button id='add_project_small_button'style='cursor:pointer;width: 100%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px; '>
                    + ADD PROJECT
                </button>
            
            </div>
        </div>

        <!-- 4th row: 1 heading, says that assigned employees are under it-->
        <div class='box-create' style=' margin-top:-20px;width:100%; height:40px;  background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='font-size:20px; line-height:40px;'>Assigned Employees</h1>
            </div>
        </div>


        <?php

            // Get all from assigbment_managers where the manager id is the current manager's id
            $sql = "SELECT * FROM assignment_managers WHERE manager_id ='$manager_id'";
            // Put the result into $result
            $result = mysqli_query($conn, $sql);
            // Creates the lines of employees that are assigned to the manager
            while ($row = $result->fetch_assoc()) {
                if ($row['emp_id'] != null) {         
                    // Creating the project box
                    echo "  <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
                                <div id='projectBox' style='width: 97%; height:50px;
                                    margin:0 auto;
                                    background-color: rgb(144, 223, 255);
                                    border-radius: 4px;font-size:16px;'>
                                    <div style='float:left;margin-left:12px;'>
                                        ID: ".$row['emp_id']." | Employee E-mail: ".$row['emp_email']."
                                    </div>
                                </div>
                            </div>";
                }
            }
        ?>

        <!-- Area for the button to add more employees to the manager -->
        <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
            <div id='assign_project_box' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;'>
                
                <button id='add_employee_small_button'style='cursor:pointer;width: 100%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px; '>
                    + ADD EMPLOYEE
                </button>
            
            </div>
        </div>
    </div>
</section>
<!-- End main part of page -->















<!-- Hidden modals -->
<div id="small_Modal" class="modal" style='display:none; z-index:6'>
    <div id='add_emp_id_small' style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:148px; width:300px;'>
        
            <div>
            <!-- <select name='emp_id' style='width: 150px;
                height: 40px;
                float:left;
                margin:0 auto;
                border: none;
                float:right;
                background-color:white;
                font-family: arial;
                font-size: 16px;'> -->
                <?php 
                    // // Get the company name 
                    // $org_id = $_SESSION['u_org_id'];
                    // // Get all the managers from that company
                    // $sql = "SELECT * FROM employees WHERE emp_org = '$org_id';";
                    // // put the result into $result
                    // $result = mysqli_query($conn, $sql);
                    

                    // // Put each employee into an option 
                    // while ($row = $result->fetch_assoc()) {
                        
                    //     $added = "";
                    //     $add = 'not added';
                    //     $email = $row['emp_email'];
                    //     $emp_id = $row['emp_id'];
                    //     $sql2 = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id' AND project_id = '$pid';";
                    //     $result2 = mysqli_query($conn, $sql2);
                    //     $resultCheck = mysqli_num_rows($result2);
                    //     if ($resultCheck > 0){
                    //         $added = " (Already added to project)";
                    //         $add = "added";
                    //     }
                    //     echo "<option value='$emp_id'>$email $added</option>";
                    // }
                    

                ?>
            <!-- </select> -->
            <input type='text' placeholder='Search' style='width: 288px;
                margin-top:1px;
                height: 34px;
                border: none;
                
                padding: 0px 0px 0px 12px;
                font-family: arial;
                
                font-size: 14px;
               '>
            </div>

            <div>
            <button type='sumbit' form='add_employee_form'name='project_submit' style=';width: 148px;
                margin-top:75px;
                height: 34px;
                border: none;
                margin-left:1px;
                float:left;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Add
            </button>
        
        <button type='sumbit' id='exit_small_modal' name='project_submit' style=';width: 148px;
            margin-top:75px;
            height: 34px;
            border: none;
            margin-right:1px;
            float:right;
            background-color: rgb(66, 85, 252);
            font-family: arial;
            color: #fff;
            font-size: 14px;
            cursor: pointer;'>Cancel
        </button>
        </div>
            <form id='add_employee_form' method='POST' action='assign_employee.php'>
            </form>
    </div>
</div>



<div id="small_modal_project" class="modal" style='display:none; z-index:6'>
    <div style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:93px; width:150px;'>
        <form method='POST' action='assign_project.php'>
            <select name='project_id' style='width: 150px;
                height: 40px;
                float:left;
                border: none;
                background-color: white;
                font-family: arial;
                font-size: 16px;'>
                <?php 
                    // Get the company id
                    $org_id = $_SESSION['u_org_id'];
                    // Get all the projects from that company
                    $sql = "SELECT * FROM projects WHERE status = 'active' AND org_id = '$org_id';";
                    // Put the result into $result
                    $result = mysqli_query($conn, $sql);
                    

                    // Put each project into an option 
                    while ($row = $result->fetch_assoc()) {
                        
                        $pid = $row['project_id'];
                        $project_name = $row['project_name'];
                        // $added = "";
                        // $manager_id = $_SESSION['current_manager_id'];
                        // $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
                        // $result2 = mysqli_query($conn, $sql2);
                        // $resultCheck = mysqli_num_rows($result2);
                        // if ($resultCheck > 0){
                        //     $added = " (Already added to this manager)";
                        // }
                        echo "<option value='$pid'>$project_name $added</option>";
                    }
                    
                ?>
            </select>
            <button type='sumbit' style='width: 150px;
                margin-top:1px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Add
            </button>
        </form>
        <button type='sumbit' id='exit_small_modal_manager' name='project_submit' style=';width: 150px;
            margin-top:1px;
            height: 34px;
            border: none;
            background-color: rgb(66, 85, 252);
            font-family: arial;
            color: #fff;
            font-size: 14px;
            cursor: pointer;'>Cancel
        </button>
    </div>
</div>












<!-- Get the JQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
<script>
    // When the page is ready, do the following
    $(document).ready(function() {
        // What happens if the add_employee_small_button button is clicked
        $( "#add_employee_small_button" ).click( function() {
            // Display the small_Modal modal
            $("#small_Modal").css("display","block");
        });
        // What happens if the exit_small_modal button is clicked
        $( "#exit_small_modal" ).click( function() {
            // stop displaying the small_Modal modal
            $("#small_Modal").css("display","none");  
        });
        // What happens if the add_manager_small_button button is clicked
        $( "#add_project_small_button" ).click( function() {
            // Display the small_modal_manager modal
            $("#small_modal_project").css("display","block");
        });
        // What happens if the exit_small_modal_manager button is clicked
        $( "#exit_small_modal_manager" ).click( function() {
            // stop displaying the small_modal_manager modal
            $("#small_modal_project").css("display","none");     
        });
        // What happens when you click the delete employee button
        $( "#delete_manager" ).click( function() {
            var check = confirm("Are you sure you want to DELETE this manager? (Can be recovered)")
            manager_delete = 'yes';
            if (check == true){
                $.post('delete_manager.php',{manager_delete:manager_delete}, function(){
                    window.location.replace('http://localhost/phplessons/view_managers.php')
                })
                
            }
        });
    });
</script>
