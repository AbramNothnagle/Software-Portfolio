<!-- Adds a font from google. Name: Lato -->
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
<!-- Adds a font into the page. Name: font-awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Adds the stylesheet style_now.css to the page -->
<link rel="stylesheet" type="text/css" href="style_nav.css">

<div id='div_session_write' style='display:none;'></div>







<!-- Puts the navigation on the left 25% of the page. The nav section -->
<div style='width:25%; float:left; margin-left:20px;'>    

    <!-- Creates the top of the form where the employee's name is displayed -->
    <div style='width:100%; height:40px; background-color:rgb(149, 149, 149);margin-bottom:0px;'>
        <div id='top-bar' style='margin-left:20px;'>
            <h4>Navigation</h4>
        </div>
    </div>

    <!-- Create link to the home page -->
    <a class='nav-link' href='index.php'><span>Home</span></a>

    <!-- Button to open links to all projects -->
    <button id='project-dropdown' class='nav-add-button' ><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>

    <!-- Create link to view projects page -->
    <a class='nav-link' href='view_projects.php'><span>Projects</span></a>

    <!-- Start php code -->
    <?php 

        // Create database connection
        include 'includes/dbh.inc.php';
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Get all projects that are active from that company
        $sql = "SELECT * FROM projects WHERE status = 'active' AND org_id = '$org_id'";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Create a dropdown like menu to select the projects
        echo "<div style='display:none;' id='project-list'>";
        // Go throught the results
        while ($row = $result->fetch_assoc()) {
            // Get the project name
            $project_name =  $row['project_name'];
            // Get the project id
            $project_id = $row['project_id'];
            // Check if the project name is more than 28 characters
            if (strlen($project_name) > 28) {
                // Cut down the length of the string
                $project_name = substr($project_name, 0, 26)." ...";
            }
            // Put the project as an option to click
            echo "<form method='GET' action='viewHours.php' class='form-nav'>
                <input type='hidden' name='project_id' value='".$row['project_id']."'>
                <button type='submit' class='dropdown-open-button'><span class='left-float'>$project_name</span></button></form>";

            }
        // Ends the dropdown like menu
        echo "</div>";

    ?>
    <!-- End php code -->

    <!-- Create link the the main calender -->
    <a class='nav-link' href='main_calendar.php'><span>Calendar</span></a>

    <!-- Create link to view clocked in page to see who's clocked in -->
    <a class='nav-link' href='view_clocked_in.php'><span>View Employees Clocked In</span></a>

    <!-- Button to open links to all managers -->
    <button id='manager-dropdown' class='nav-add-button' ><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>

    <!-- Link to view manager page -->
    <a class='nav-link' href='view_managers.php'><span>View Managers</span></a>

    <!-- Start php code -->
    <?php

        // Get all of the managers from the company
        $sql = "SELECT * FROM managers WHERE manager_org_id = '$org_id' AND status='active';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Start a dropdown like menu with all the managers
        echo "<div style='display:none;' id='manager-list'>";
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the manager's E-mail
            $manager_email =  $row['manager_email'];
            // Check if the manager's E-mail is longer than 28 characters
            if (strlen($manager_email) > 28) {
                // Cut down the string length
                $manager_email = substr($manager_email, 0, 26)." ...";
            }
            // Creates link to view that manager
            echo "<form method='POST' action='select_manager.php' class='form-nav'>
            <input type='hidden' name='manager_id' value='".$row['manager_id']."'>
            <input type='hidden' name='manager_first' value='".$row['manager_first']."'>
            <input type='hidden' name='manager_last' value='".$row['manager_last']."'>
            <button class='dropdown-open-button' type ='submit' name='view_manager'><span class='left-float'>
            $manager_email</span></button></form>";

        }
        // End drop down like menu
        echo "</div>";

    ?>
    <!-- End php code -->

    <!-- Button to open dropdown to see links to all employees -->
    <button id='employee-dropdown' class='nav-add-button'><span class='button-text'><p style="font-size:14px;margin-left:5px;" class='fa fa-chevron-right'></p></span></button>

    <!-- Link to view employees page -->
    <a class='nav-link' href='view_employees.php'><span>View Employees</span></a>

    <!-- Start php code -->
    <?php 

        // Get all employees from the company
        $sql = "SELECT * FROM employees WHERE emp_org = '$org_id' AND status='active';";
        // Put the result into $result
        $result = mysqli_query($conn, $sql);
        // Start a dropdown like menu where you can select from all employees
        echo "<div style='display:none;' id='employee-list'>";
        // Go through the results
        while ($row = $result->fetch_assoc()) {
            // Get the employee's E-mail
            $emp_email = $row['emp_email'];
            // Check if the employee's E-mail is longer than 28 characters
            if (strlen($emp_email) > 28) {
                // Cut down the string length of the E-mail
                $emp_email = substr($emp_email, 0, 26)." ...";
            }
            // Create link to view the employee
            echo "<form method='GET' action='employee_entries.php' class='form-nav'>
            <input type='hidden' name='emp_id' value='".$row['emp_id']."'>
            <button type ='submit' class='dropdown-open-button'><span class='left-float'>
            $emp_email</span></button></form>";

        }
        // End dropdown like menu
        echo "</div>";

    ?>
    <!-- End php code -->

</div>
<!-- End nav section -->









<script>

    // When the page is ready do this
    $(document).ready(function readyDoc() {

        // Initialize variables      
        var clicked_project_id, input;
        var searching = false;
        var project_dropdown = 'closed';
        var employee_dropdown = 'closed';
        var manager_dropdown = 'closed';
        var projectdropdown = $('#project-dropdown-status').val()
        

        if (projectdropdown == 'open'){
            project_dropdown = 'open';
        }
       
        // When happens if the project dropdown button is clicked
        $( "#project-dropdown" ).click(function() {
            // Check if it is closed
            if (project_dropdown == 'closed'){ 
                // Display the dropdown list
                $(document.getElementById('project-list')).css('display','block');
                // Set the status to open
                project_dropdown = 'open';
                // Change the arrow direction of the project dropdown button to down
                $("#project-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
                //
                $('#div_session_write').load('session_write.php?project-dropdown=open');
            // Check if it is open
            } else if (project_dropdown == 'open') {
                // Stop displaying the dropdown list
                $(document.getElementById('project-list')).css('display','none');  
                // Set the status to closed
                project_dropdown = 'closed';
                // Change the arrow direction of the project dropdown button to the right
                $("#project-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
                //
                $('#div_session_write').load('session_write.php?project-dropdown=closed');
            }
        })

        // What happens if the employee dropdown button is clicked
        $( "#employee-dropdown" ).click(function() {
            // Check if it is closed
            if (employee_dropdown == 'closed'){ 
                // Display the dropdown list
                $(document.getElementById('employee-list')).css('display','block');
                // Set the status to open
                employee_dropdown = 'open';
                //
                $("#employee-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
            // Check if it is open
            } else if (employee_dropdown == 'open') {
                // Stop displaying the dropdown list
                $(document.getElementById('employee-list')).css('display','none');  
                // Set the status to closed
                employee_dropdown = 'closed';
                //
                $("#employee-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
            }
        })
        // Check if it is closed
        $( "#manager-dropdown" ).click(function() {
            if (manager_dropdown == 'closed'){ 
                // Display the dropdown list
                $(document.getElementById('manager-list')).css('display','block');
                // Set the status to open
                manager_dropdown = 'open';
                //
                $("#manager-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-down'></p></span>");
            // Check if it is open
            } else if (manager_dropdown == 'open') {
                // Stop displaying the dropdown list
                $(document.getElementById('manager-list')).css('display','none');  
                // Set the status to closed
                manager_dropdown = 'closed';
                //
                $("#manager-dropdown").html("<span class='button-text'><p style='font-size:14px;margin-left:5px;' class='fa fa-chevron-right'></p></span>");
            }
        })
    });
    // ----- End on document.ready -----




</script>
