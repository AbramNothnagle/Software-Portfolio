    <div style='width:25%; float:left; margin-left:20px;'>    
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="style_nav.css">

        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149);margin-bottom:0px;'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Navigation</h4>
            </div>
        </div>   

        <button id='project-dropdown' class='nav-add-button' ><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>
        
        <a class='nav-link' 
        href='view_assigned_projects.php'><span>Projects</span></a>

        <?php 

            //Create a connection to database
            include 'includes/dbh.inc.php';
            // Get the manager id
            $manager_id = $_SESSION['m_id'];
            // Get the company id
            $org_id = $_SESSION['m_org_id'];
            // Get all of the assignments for that manager
            $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
            // Put the result into $result
            $result = mysqli_query($conn, $sql);


            echo "<div style='display:none;' id='project-list'>";
            while ($row = $result->fetch_assoc()) {
           

                
                if ($row['project_id'] != null) {
                // Get the project id
                $project_id = $row['project_id'];
                    // Get all of the assignments for that manager
                    $sql = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id = '$org_id' AND status = 'active';";
                    // Put the result into $result
                    $result2 = mysqli_query($conn, $sql);
                    while ($row2 = $result2->fetch_assoc()) {
                        
                        $project_name =  $row2['project_name'];
                        
                        if (strlen($project_name) > 28) {
                            $project_name = substr($project_name, 0, 26)." ...";
                        }
                        // Creating the project box
                        // echo "<div style='width:100%;height:25px;color:black;font-size:16px; margin-bottom:1px;line-height:25px;>";
                        echo "<form method='GET' action='view_hours_for_managers.php' class='form-nav'>
                        <input type='hidden' name='project_id' value='".$row2['project_id']."'>

                        <button type='submit' class='dropdown-open-button'><span class='left-float'>$project_name</span></button></form>";
                        // echo "</div>";
                        
                    }
                }
            }
            
            echo "</div>";

        ?>
        

        <button id='employee-dropdown' class='nav-add-button'><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>


        <a class='nav-link'
        href='view_assigned_employees.php'><span>View Employees</span></a>

        <?php 

            
            // Get all assignmenst to that manager
            $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
            // Put the result into $result
            $result3 = mysqli_query($conn, $sql);
        
            echo "<div style='display:none;' id='employee-list'>";
            
            while ($row3 = $result3->fetch_assoc()) {

                if ($row3['emp_id'] != null) {
                    // Get the project id
                    $employee_id = $row3['emp_id'];
                   
                    // Get all of the assignments for that manager
                    $sql = "SELECT * FROM employees WHERE emp_id = '$employee_id' AND emp_org = '$org_id'";
                    // Put the result into $result
                    $result = mysqli_query($conn, $sql);
                    while ($row2 = $result->fetch_assoc()) {
                        
                        $emp_email =  $row2['emp_email'];
                        
                        if (strlen($emp_email) > 28) {
                            $emp_email = substr($emp_email, 0, 26)." ...";
                        }
                        // Creating the project box
                        // echo "<div style='width:100%;height:25px;color:black;font-size:16px; margin-bottom:1px;line-height:25px;>";
                        echo "<form method='GET' action='employee_entries_for_managers.php' class='form-nav'>
                        <input type='hidden' name='emp_id' value='".$row2['emp_id']."'>
                        <button type ='submit' class='dropdown-open-button'><span class='left-float'>
                        $emp_email</span></button></form>";
                        // echo "</div>";
                        
                    }
                }
            }
            
            echo "</div>";
            // var_dump($bbox);
        ?>

    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>

    $(document).ready(function readyDoc() {
                
        var clicked_project_id, input;
        var searching = false;
        var project_dropdown = 'closed';
        var employee_dropdown = 'closed';
        var manager_dropdown = 'closed';
        var projectdropdown = $('#project-dropdown-status').val()
        if (projectdropdown == 'open'){
            project_dropdown = 'open';
        }
       
        $( "#project-dropdown" ).click(function() {
            if (project_dropdown == 'closed'){ 
                $(document.getElementById('project-list')).css('display','block');
                project_dropdown = 'open';
                $("#project-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
                $('#div_session_write').load('session_write.php?project-dropdown=open');
            } else if (project_dropdown == 'open') {
                $(document.getElementById('project-list')).css('display','none');  
                project_dropdown = 'closed';
                $("#project-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
                $('#div_session_write').load('session_write.php?project-dropdown=closed');
            }
        })

        $( "#employee-dropdown" ).click(function() {
            if (employee_dropdown == 'closed'){ 
                $(document.getElementById('employee-list')).css('display','block');
                employee_dropdown = 'open';
                $("#employee-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
            } else if (employee_dropdown == 'open') {
                $(document.getElementById('employee-list')).css('display','none');  
                employee_dropdown = 'closed';
                $("#employee-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
            }
        })
        $( "#manager-dropdown" ).click(function() {
            if (manager_dropdown == 'closed'){ 
                $(document.getElementById('manager-list')).css('display','block');
                manager_dropdown = 'open';
                $("#manager-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
            } else if (manager_dropdown == 'open') {
                $(document.getElementById('manager-list')).css('display','none');  
                manager_dropdown = 'closed';
                $("#manager-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
            }
        })


    });




</script>