<?php
    // Put the header in the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // if not, exit the code
        exit;
    }
    // Connect to the database
    include 'includes/dbh.inc.php';
?>


<!-- add the stylesheet style_now to the page -->
<link rel="stylesheet" type="text/css" href="style_now.css">


<!-- Main part of page -->
<section class="main-container">

    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>

    
    <div class="main-wrapper">
        
        <!-- Displays the page name -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Employees</h4>
            </div>
        </div>


        <div class='box-create' style='width:100%; height:62px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                
                <!-- <form id='search-form' method='GET'> -->
                    <button id='employee-search' type='submit' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                    font-size: 16px;' >Search</button>
                    <input  class='searchbar-style-1' id='search-input' placeholder='Search employees'type='text' name='search'>
                <!-- </form> -->

                <button id='all_button' class='button-style-3' style='width:60px;color:white;'>
                    All
                </button>
                
                <a class='button-style-1' style ='color:#fff;line-height:40px;' href='eaccount.php'>Add Employee</a>
                

            </div>
        </div>
        
        <div class='box-create' style='width:100%; height:60px; margin-top:0px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Button to get data for the employees -->
                <button id='data_button' type='submit' name='commentSubmit' 
                    style=' width: 100px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    Data
                </button>

                <!-- Button to make an export of the employees -->
                <button type='submit' name='delete3' id='export'
                    style=' width: 150px;
                    margin-top:20px;
                    height: 40px;
                    line-height:40px;
                    float:right;
                    margin-right:20px;
                    border: none;
                    background-color: rgb(194, 194, 194);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    Export
                </button>






                

                <!-- Drop down menu to choose export type -->
                <select style='float:right;' class='dropdown-style-1' id='export-type'>
                    <option value='csv'>csv</option>
                    <!-- <option value='excel'>excel</option>
                    <option value='pdf'>pdf</option> -->
                </select>
            </div>
        </div>

        <!-- 3rd row: 1 button -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>  
            <div style='margin-left:20px;'>
                <h5 style='float:right;'> sort by: </h5>
            </div>
        </div>

        
        <!-- 4th row: 1 button -->
        <div class='box-create' style='width:100%; height:120px; background-color:rgb(247, 247, 247)'>  




            <div id='top-bar' style='margin-left:20px;'>
                <!-- Creates the drop down to select sorting type -->
                <select id='sorting' style='width: 150px;
                    margin-right:20px;
                    margin-top:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;'>
                    <option>Date Created</option>
                    <option>Last</option>
                    <option>First</option>
                    <option>E-mail</option>
                </select>
            </div>
        </div>
        <!-- 3rd row end -->


        <!-- Start the php code -->
        <?php

            // Get the org id
            $org_id =  $_SESSION['u_org_id'];
        ?>
        <!-- End php code -->



        <!-- Start the list div -->
        <div id='list'>
            
            
        </div>
         <!-- End list div -->




    </div>
</section>
<!-- End main part of page -->




<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>


            
    // When the page is ready, do this
    $(document).ready(function() {
    

        $("#export").click(function() {
        export_type = $('#export-type').val()
        filter = $('#filter-type').val()

            if (export_type == 'csv') {
                if (filter == 'none') {
                    window.location.href = "employee_export_csv.php";
                } else if (filter == 'search') {
                    input = $('#filter-type').attr("data-search")
                    window.location.href = "export_csv_employee_search.php?search=" + input;
                }

            } else if (export_type == 'excel') {
                if (filter == 'none') {
                    window.location.href = 'export_excel_employees.php';
                } else if (filter == 'search') {
                    input = $('#filter-type').attr("data-search")
                    window.location.href = "export_excel_employees.php?search=" + input;
                }
            }
        })

        // Initialize variables 
        var input;
        // Default searching to false 
        var searching = false;

        // Get all of the entries from the project
        $.post('load_employees_to_objects.php', function(result) {
            // Turn the result into JSON objects
            employees = JSON.parse(result)
            // Display all of these projects at the start of page
            display_all()
        })

        // Function to display all of the entries
        function display_all() {
            // Clear all managers
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < employees.length; i++) {
                // Get the html for the entry
                text = prepare_entry_line(employees[i].first, employees[i].last, employees[i].id, employees[i].email)
                // // Put the entry on #list
                $('#list').append(text)
            }
        }

        function display_search() {
            // Clear all managers
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < employees.length; i++) {  
                // Check if the search is in the name
                if ( employees[i].email.toLowerCase().includes(input.toLowerCase()) ) {
                    // Get the html for the entry
                    text = prepare_entry_line(employees[i].first, employees[i].last, employees[i].id, employees[i].email)
                    // Put the entry on #list
                    $('#list').append(text)
                }
            }
        }



        // Create the entry lines with html
        function prepare_entry_line(first, last, id, email) {
            // Create the text needed to create an entry
            text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> First Name: " + first + " | Last Name: " + last + " | Email: " + email + "</div><form style='position:relative; float:right; margin-right:26px;' method='GET' action='employee_entries.php'><input type='hidden' name='emp_id' value='" + id + "'><button type='submit' style='width: 180px;height: 30px;margin-right: 10px;border: none;background-color: #f3f3f3;font-family: arial;font-size: 16px;color: #111;cursor: pointer;'>Select Employee</button></form></div></div>";
            // Return the text
            return text
        }

        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            // Check the sorting type is alphabetical
            if ($('#sorting').val() == 'last') {
                // Save the original object order
                employees_original = employees
                // Sort alphabetically
                employees = merge_alphabetical(employees)
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            // Check if the sorting type is none
            } else if ($('#sorting').val() == 'none') {
                // Set to orignal order
                employees = employees_original
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            }
        })

        // What happens if you click the search button
        $( "#employee-search" ).click(function() {
            // Get the search typed in
            input = $('#search-input').val()
            // Clear all projects
            $('#list').html('')
            // Display the all button
            $(document.getElementById('all_button')).css('display','block');
            // Display projects that have names like the search word
            display_search()
            // Set searching to true
            searching = true;
        })

        // When happens if a key on while on the search bar is pressed
        $("#search-input").keyup(function(event) {
            // Check if it was enter
            if (event.keyCode === 13) {
                // Get the search typed in
                input = $('#search-input').val()
                // Clear all projects
                $('#list').html('')
                // Display the all button
                $(document.getElementById('all_button')).css('display','block');
                // Display projects that have names like the search word
                display_search()
                // Set searching to true
                searching = true;
            }
        })

        // What happens if the all button is clicked
        $( "#all_button" ).click(function() {
            // Display all of these projects at the start of page
            display_all()
            // Stop displaying the all button
            $(document.getElementById('all_button')).css('display','none');
            // Set searching to false
            searching = false;
        })

        // What happens if the data button is clicked
        $( "#data_button" ).click(function() {
            // Display the data modal
            $(document.getElementById('data_modal')).css('display','block');
        })

        // What happens if the exit button is clicked
        $( "#exit_data" ).click(function() {
              
            $(document.getElementById('data_modal')).css('display','none');
            
        })
        // What happens if you click outside the edit project modal
        $( "#outside_modal_data" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('data_modal')).css('display','none');
            
        })

                //Make the DIV element draggagle, makes data_modal draggable :
                dragElement(document.getElementById(("movable_data")));

            function dragElement(elmnt) {
            var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            if (document.getElementById(elmnt.id + "header")) {
                /* if present, the header is where you move the DIV from:*/
                document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
            } else {
                /* otherwise, move the DIV from anywhere inside the DIV:*/
                elmnt.onmousedown = dragMouseDown;
            }

            function dragMouseDown(e) {
                e = e || window.event;
                // get the mouse cursor position at startup:
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                // call a function whenever the cursor moves:
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                // calculate the new cursor position:
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // set the element's new position:
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                /* stop moving when mouse button is released:*/
                document.onmouseup = null;
                document.onmousemove = null;
            }
            }

    });
    // End document.ready

</script>

<!-- Hidden Modals -->
<div class='main-container'>


    <div id="data_modal" class="modal" style='background-color:transparent;display:none;'>
        <div id='outside_modal_data' style='background-color:transparent; display:block; z-index:5;' class='modal'></div>
        <!-- Modal content -->
        <div style='left:50%; margin-top:2%; position: absolute; margin-left:-350px;'>
            <div style='width:700px; height:230px; position:absolute; background-color:#fff;z-index:6;border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='movable_data'>
                
                <div id='movable_dataheader' style='cursor: move;height:40px;background-color: rgb(200, 200, 200);'>
                        <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Data For Employees</p>
                </div>

                <div style='margin-top:15px;height:30px;line-height:20px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Total Employees</p>
                    <p style='float:left'><?php 
                        // Get all projects from the company
                        $sql = "SELECT * FROM employees WHERE status = 'active' AND emp_org = '$org_id'";
                        // Put the results into $result
                        $result = mysqli_query($conn, $sql);
                        // Get the number of projects found
                        $total_employees = mysqli_num_rows($result);
                
                        echo ": "; echo $total_employees; ?></p>
                </div>


                <div style='height:44px;'>
                    <!-- <p style='float:left;margin-left:20px;padding:0;'>Employees Assigned To A Project</p>
                    <p style='float:left;margin-left:120px;padding:0;'>Employees Not Assigned To A Project</p> -->
                </div>

                <div style='height:20px;'>
                    <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(66, 85, 252);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        
                        cursor: pointer;'>Export</button>
                
                    <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Exit</button>
                </div>    
                    
                    
            </div>
        </div>
    </div>

</div>