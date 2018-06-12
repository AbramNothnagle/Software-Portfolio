<?php

    // Put the header into the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // if not, exit the code
        exit;
    }
    // Create the connection to the database
    include 'includes/dbh.inc.php';

?>

<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Put stylesheet style_now into the page -->
<link rel="stylesheet" type="text/css" href="style_now.css">

<!-- Start of main part of page -->
<section class="main-container">
    <div style='width:1000px; margin:0 auto; '>          

        <!-- Create 3 columns for buttons -->
        <div class ='columns' style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>
            <!-- Button to recover -->
            <button id='recover_projects' type='submit'>
                Recover Deleted Projects
            </button>

            <!-- Button to make an export of the project -->
            <button id='recover_employees' type='submit'>
                Recover Deleted E Accounts
            </button>

            <!-- Button to make an export of the project -->
            <button id='recover_entries' type='submit'>
                Recover Deleted Entries
            </button>

            <div>
            </div>

            <!-- Button to make an export of the project -->
            <button id='recover_managers' type='submit'>
                Recover Deleted M Accounts
            </button>
        </div>
        <!-- End columns -->

        
        <br>

        <!-- Button to make an export of the project -->
        <!-- <div style='float:left;'>
            <button type='submit' id='recover_all' style='width:180px;' class ='button-style-2'>
                Recover All Projects
            </button>
        </div>
        <br>
        <br> -->


        <div id='white_top' style='height:5px; width:100%;background-color:rgb(247, 247, 247); display:none'></div>

        <div class='alert_none' id ='project_none'><h3>There are no deleted projects! Time to celebrate!</h3></div>
        <div class='alert_none' id ='entries_none'><h3>There are no deleted entries! Time to celebrate!</h3></div>
        <div class='alert_none' id ='employees_none'><h3>There are no deleted employees! Time to celebrate!</h3></div>
        <div class='alert_none' id ='managers_none'><h3>There are no deleted managers! Time to celebrate!</h3></div>

        <!-- Start list div -->
        <div id='list'>
        </div>
        <!-- End list div -->





    </div>
</section>
<!-- End main part of page -->

<script>



    // When the page is ready do this
    $(document).ready(function() {
        // Set the project_deleted_load
        project_deleted_load = 'set'
        // Set the entries_deleted_load
        entries_deleted_load = 'set'
        // Set the employees_deleted_load
        employees_deleted_load = 'set'
        // Set the managers_deleted_load
        managers_deleted_load = 'set'
        // Get all of the entries from the project
        $.post('load_deleted_projects_to_objects.php', {project_deleted_load:project_deleted_load}, function(result) {
            // Turn the result into JSON objects
            project = JSON.parse(result)
            // Display all of these entries at the start of page
            display_all_projects()
        })

        $.post('load_deleted_entries_to_objects.php', {entries_deleted_load:entries_deleted_load}, function(result) {
            // Turn the result into JSON objects
            entries = JSON.parse(result)
        })

        $.post('load_deleted_employees_to_objects.php', {employees_deleted_load:employees_deleted_load}, function(result) {
            // Turn the result into JSON objects
            employee_accounts = JSON.parse(result)
        })

        $.post('load_deleted_managers_to_objects.php', {managers_deleted_load:managers_deleted_load}, function(result) {
            // Turn the result into JSON objects
            manager_accounts = JSON.parse(result)
        })
        
        // What happens if the recover deleted projects button is clicked
        $("#recover_projects").click(function() {
            // Display all deleted projects
            display_all_projects()
        })
        // What happens if the recover deleted projects button is clicked
        $("#recover_entries").click(function() {
            // Display all deleted projects
            display_all_entries()
        })
        // What happens if the recover deleted projects button is clicked
        $("#recover_employees").click(function() {
            // Display all deleted projects
            display_all_employees()
        })
        // What happens if the recover deleted projects button is clicked
        $("#recover_managers").click(function() {
            // Display all deleted projects
            display_all_managers()
        })



        // // What happens if the recover all button is clicked
        // $("#recover_all").click(function(){
        //     // Set recover_all to set
        //     recover_all = 'set'
        //     // Set all projects in the database to active
        //     $.post('recover_all.php', {recover_all:recover_all})
        // })


    });
    // Function to display all of the entries
    function display_all_projects() {
        // Clear all projects
        $('#list').html('')

        if (project.length == 0) {
            $('.alert_none').css('display','none')
            $('#white_top').css('display','none')
            $('#project_none').css('display','block')
        } else {
            $('#white_top').css('display','block')
            $('.alert_none').css('display','none')
        }
        // Go through every entry
        for (i = 0; i < project.length; i++) {
            // Get the html for the entry
            text = prepare_entry_line_project(project[i].name, project[i].id, project[i].description, project[i].date)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
    }

    

    // Function to display all of the entries
    function display_all_entries() {

        // Clear all projects
        $('#list').html('')

        if (entries.length == 0) {
            $('.alert_none').css('display','none')
            $('#white_top').css('display','none')
            $('#entries_none').css('display','block')
        } else {
            $('#white_top').css('display','block')
            $('.alert_none').css('display','none')
        }
        // Go through every entry
        for (i = 0; i < entries.length; i++) {
            // Get the html for the entry
            text = prepare_entry_line_entry(entries[i].date, entries[i].time, entries[i].project_name, entries[i].email, entries[i].id)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
    }


    // Function to display all of the entries
    function display_all_employees() {

        // Clear all projects
        $('#list').html('')
        
        if (employee_accounts.length == 0) {
            $('.alert_none').css('display','none')
            $('#white_top').css('display','none')
            $('#employees_none').css('display','block')
        } else {
            $('#white_top').css('display','block')
            $('.alert_none').css('display','none')
        }
        
        // Go through every entry
        for (i = 0; i < entries.length; i++) {
            // Get the html for the entry
            text = prepare_entry_line_employee(employee_accounts[i].first, employee_accounts[i].last, employee_accounts[i].email, employee_accounts[i].id)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
    }

    // Function to display all of the entries
    function display_all_managers() {

        // Clear all projects
        $('#list').html('')

        if (manager_accounts.length == 0) {
            $('.alert_none').css('display','none')
            $('#white_top').css('display','none')
            $('#managers_none').css('display','block')
        } else {
            $('#white_top').css('display','block')
            $('.alert_none').css('display','none')
        }
        
        // Go through every entry
        for (i = 0; i < manager_accounts.length; i++) {
            // Get the html for the entry
            text = prepare_entry_line_manager(manager_accounts[i].first, manager_accounts[i].last, manager_accounts[i].email, manager_accounts[i].id)
            // Put the entry on #list
            var entry = $('#list').append(text)
        }
    }

    // Create the entry lines with html
    function prepare_entry_line_project(name, id, description, date) {
        // Create the text needed to create an entry
        text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> Project Name: " + name + "</div><input type='hidden' name='project_id' value=" + id + "><input type='hidden' name='project_name' value='" + name + "'><button value='" + id + "' data-project='" + name + "' style='float:right; margin-top:11px;' class='box-button recover_project' type ='submit'>Recover</button></div></div>";
        // Return the text
        return text
    }

    // Create the entry lines with html
    function prepare_entry_line_entry(date, time, project_name, email, id) {
        // Create the text needed to create an entry
        text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> Date: " + date + " | Length: " + time + " | Project: " + project_name + " | Employee E-mail: " + email + "</div><input type='hidden' name='project_id' value=" + id + "><input type='hidden' name='project_name' value='" + id + "'><button value='" + id + "' data-project='" + id + "' data-email='" + email + "' style='float:right; margin-top:11px;' class='box-button recover_entry' type ='submit'>Recover</button></div></div>";
        // Return the text
        return text
    }

    function prepare_entry_line_employee(first, last, email, id) {
        // Create the text needed to create an entry
        text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> First Name: " + first + " | Last Name: " + last + " | E-mail: " + email + "</div><input type='hidden' name='project_id' value=" + id + "><input type='hidden' name='project_name' value='" + id + "'><button value='" + id + "' data-email='" + email + "' style='float:right; margin-top:11px;' class='box-button recover_employee' type ='submit'>Recover</button></div></div>";
        // Return the text
        return text
    }
    function prepare_entry_line_manager(first, last, email, id) {
        // Create the text needed to create an entry
        text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> First Name: " + first + " | Last Name: " + last + " | E-mail: " + email + "</div><input type='hidden' name='project_id' value=" + id + "><input type='hidden' name='project_name' value='" + id + "'><button value='" + id + "' data-email='" + email + "' style='float:right; margin-top:11px;' class='box-button recover_manager' type ='submit'>Recover</button></div></div>";
        // Return the text
        return text
    }



    // What happens if the recover button is clicked
    $('#list').on('click', '.recover_project' , function() {
        // Get the project name
        project_name = $(this).attr("data-project");
        // Make the user confirm they want to recover it
        if (confirm("Are you sure you want to recover project " + project_name + " ?") == true) {
            // Get the id of the project
            project_id = $(this).val();
            // Set recover to set
            recover = 'set'
            // Set all projects in the database to active
            $.post('recover_project.php', {recover:recover,project_id:project_id})
            // Go through projects
            for (i = 0; i < project.length; i++) {
                // Find the entry with the same value
                if (project_id == project[i].id) {
                    // Remove the entry
                    project.splice(i, 1);
                    // Leave the i for loop
                    break;
                }
            }
            // Display all of these entries at the start of page
            display_all_projects()
        }
    });
    // What happens if the recover button is clicked
    $('#list').on('click', '.recover_employee' , function() {
        // Get the project name
        employee_email = $(this).attr("data-email");
        // Make the user confirm they want to recover it
        if (confirm("Are you sure you want to recover employee " + employee_email + " ?") == true) {
            // Get the id of the project
            emp_id = $(this).val();
            // Set recover to set
            recover = 'set'
            // Set all projects in the database to active
            $.post('recover_employee.php', {recover:recover,emp_id:emp_id})
            // Go through projects
            for (i = 0; i < employee_accounts.length; i++) {
                // Find the entry with the same value
                if (emp_id == employee_accounts[i].id) {
                    // Remove the entry
                    employee_accounts.splice(i, 1);
                    // Leave the i for loop
                    break;
                }
            }
            // Display all of these entries at the start of page
            display_all_employees()
        }
    });
    // What happens if the recover button is clicked
    $('#list').on('click', '.recover_manager' , function() {
        // Get the manager email
        manager_email = $(this).attr("data-email");
        // Make the user confirm they want to recover it
        if (confirm("Are you sure you want to recover manager " + manager_email + " ?") == true) {
            // Get the id of the manager
            manager_id = $(this).val();
            // Set recover to set
            recover = 'set'
            // Set all projects in the database to active
            $.post('recover_manager.php', {recover:recover,manager_id:manager_id})
            // Go through projects
            for (i = 0; i < manager_accounts.length; i++) {
                // Find the entry with the same value
                if (manager_id == manager_accounts[i].id) {
                    // Remove the entry
                    manager_accounts.splice(i, 1);
                    // Leave the i for loop
                    break;
                }
            }
            // Display all of these entries at the start of page
            display_all_managers()
        }
    });
    // What happens if the recover button is clicked
    $('#list').on('click', '.recover_entry' , function() {
        // Get the project name
        employee_email = $(this).attr("data-email");
        // Make the user confirm they want to recover it
        if (confirm("Are you sure you want to recover the entry for " + employee_email + " ?") == true) {
            // Get the id of the project
            time_id = $(this).val();
            // Set recover to set
            recover = 'set'
            // Set all the entry to active
            $.post('recover_entry.php', {recover:recover,time_id:time_id})
            // Go through projects
            for (i = 0; i < entries.length; i++) {
                // Find the entry with the same value
                if (time_id == entries[i].id) {
                    // Remove the entry
                    entries.splice(i, 1);
                    // Leave the i for loop
                    break;
                }
            }
            // Display all of these entries at the start of page
            display_all_entries()
        }
    });

</script>

