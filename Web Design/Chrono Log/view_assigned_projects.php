<?php
    // Put the header in the page
    include_once 'header.php';
    // Creates the database connection with variable $conn
    include 'includes/dbh.inc.php';
?>
           
  
<!-- Main part of page -->
<section class="main-container">

    <?php   
        // Put the navigation for managers in the page
        include 'nav_for_managers.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>          
        
        <!-- Create the top bar that says Manage Projects -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149); '>
            <div id='top-bar' style='margin-left:20px;'>
                <h4>Manage Projects</h4>
            </div>
        </div>
        

        <div class='box-create' style=' width:100%; height:62px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
            
                <!-- Button to open the data modal -->
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
                    
                <!-- Search form to search projects -->
                <!-- <form method='GET' > -->
                    <!-- Button to execute search -->
                    <button id='project-search' type='submit' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                    font-size: 16px;' >Search</button>
                    <!-- Button to enter search term -->
                    <input id='search-input' placeholder='Search projects'type='text' name='search' style='padding: 0px 0px 0px 12px;float:right;width:30%;height:37px;margin-top:20px; margin-right:20px; font-size:16px;'>
                <!-- </form> -->
            

                        <button id='all_button'
                        style=' width: 60px; line-height:40px;
                        margin-top:20px;
                        height: 40px;
                        float:right;
                        display:none;
                        margin-right:20px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;'>
                        All
</button>
                    

            </div>
        </div>


        <div class='box-create' style='width:100%; height:120px; margin-top:0px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

            
                <!-- Button to make an export of the project -->
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
                </select>

            </div>
        </div>
    

        <div id='search-results' class='search-results'>
        </div>



        <!-- php code start -->
        <?php
            // Puts in a style_now style sheet
            echo '<link rel="stylesheet" type="text/css" href="style_now.css">';
            // Start the list div
            echo "<div id='list'>";
            // // Get the org id
            // $org_id = $_SESSION['m_org_id'];
            // // Get the manager's id
            // $manager_id = $_SESSION['m_id'];
            // // Get all assignmenst to that manager
            // $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
            // // Put the result into $result
            // $result = mysqli_query($conn, $sql);
            // // Check if a search has been done
            // if (isset($_GET['search'])) {
            //     // Go through results 
            //     while ($row2 = $result->fetch_assoc()) {
            //         // Check to see if the row is filled with an employee
            //         if ($row2['project_id'] != null) {
                        
            //             // Get the employee's id 
            //             $project_id = $row2['project_id'];              
            //             // Get the search phrase that was done
            //             $project_name = $_GET['search'];
            //             // Get the employees from that search term
            //             $sql2 = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id = '$org_id' AND project_name LIKE '%{$project_name}%';";
            //             // Put the result into $result2
            //             $result2 = mysqli_query($conn, $sql2);
            //             // Go through the results
            //             while ($row = $result2->fetch_assoc()) {
            //                 // Creates the lines to select that employee
            //                 include 'create_project_lines.php';
            //             }
            //         }
            //     }
            //     //
            //     //echo "<input type='hidden' id='filter-type' value='search' data-search='$emp_email'>";
            // } else {
            //     // Go through results
            //     while ($row2 = $result->fetch_assoc()) {
                    
            //         // Check to see if the row is filled with an employee
            //         if ($row2['project_id'] != null) {
            //             // Get the project's id 
            //             $project_id = $row2['project_id'];              
            //             // Get the projects from that search term
            //             $sql2 = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id = '$org_id';";
            //             // Put the result into $result2
            //             $result2 = mysqli_query($conn, $sql2);
            //             // Go through the results
            //             while ($row = $result2->fetch_assoc()) {
            //                 // Creates the lines to select that project
            //                 include 'create_project_lines.php';
            //             }
            //         }
            //     }               
            // }
            // // Get the total number of projects
            // $total_projects = mysqli_num_rows($result2);
            // ----- End list div -----
            echo "</div>";

        ?>
        <!-- End php code -->

    </div>
</section>
<!-- End main part of page -->













<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>

    $(document).ready(function readyDoc() {
        
        // Initialize variables 
        var clicked_project_id, input;
        // Default searching to false 
        var searching = false;

        // Get all of the entries from the project
        $.post('load_assigned_projects_to_objects.php', function(result) {
            
            // Turn the result into JSON objects
            project = JSON.parse(result)
            // Display all of these projects at the start of page
            display_all()
            // Set the total projects in the data modal
            $('#total_projects').text(": " +project.length)
        })

        // Function to display all of the entries
        function display_all() {
            // Clear all projects
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < project.length; i++) {
                // Get the html for the entry
                text = prepare_entry_line(project[i].name, project[i].id, project[i].description, project[i].date, project[i].job_code)
                // Put the entry on #list
                var entry = $('#list').append(text)
            }
        }

        function display_search() {
            // Clear all projects
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < project.length; i++) {  
                // Check if the search is in the name
                if ( project[i].name.toLowerCase().includes(input.toLowerCase()) ) {
                    // Get the html for the entry
                    text = prepare_entry_line(project[i].name, project[i].id, project[i].description, project[i].date, project[i].job_code)
                    // Put the entry on #list
                    var entry = $('#list').append(text)
                }
            }
        }

        // Create the entry lines with html
        function prepare_entry_line(name, id, description, date, job_code) {
            // Create the text needed to create an entry
            text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> Project Name: " + name + "</div><form style='position:relative; margin-left:47%;' method='GET' action='view_hours_for_managers.php'><input type='hidden' name='project_id' value=" + id + "><button style='float:right; margin-top:11px;' class='box-button2' type ='submit'>Select Project</button></form></div></div>";
            // Return the text
            return text
        }

        // What happens if you click the search button
        $( "#project-search" ).click(function() {
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
            
            searching = false;
        })

        // Happens if the add project button is clicked
        $( "#add_button" ).click(function() {
            // Display the myModal modal
            $(document.getElementById('myModal')).css('display','block');
            
        })
        // What happens if the cancel button is clicked on the add new project (myModal) 
        $( "#cancel" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
            
        })
        // What happens when an edit button on one of the projects in clicked
        $( ".box-button" ).click( function() {
            // Display the myModal2 modal
            $(document.getElementById('myModal2')).css('display','block');
            // Get the id of the edited project
            clicked_project_id = $(this).val();
            // Get the name of the edited project
            clicked_project_name = $(this).attr("data-project");
            // Get the date of the edited project
            clicked_project_date = $(this).attr("data-date");
            // Get the description of the edited project
            clicked_project_description = $(this).attr("data-description");
            // Get the first 10 characters of the clicked_project_date string
            format_date = clicked_project_date.slice(0, 10);
            // Prefill the edit project modal with the current name
            $("#project_name").attr("value", clicked_project_name)
            // Prefill the project with the current chosen date
            $("#date_edit").attr("value", format_date)
            // Put the projects id into the form needed to update the project
            $("#project_id").attr("value", clicked_project_id)
            // Prefill the project the current description
            $("#description_edit").text(clicked_project_description)
            
        })

        // What happens if the cancel button on the editing project modal (myModal2) is clicked
        $( "#cancel_edit" ).click(function() {
            // Stop displaying myModal2
            $(document.getElementById('myModal2')).css('display','none');
            
        })

        // What happens if the export button is clicked
        $("#export").click(function() {
            // Get the chosen export type
            export_type = $('#export-type').val()
            // Gets if there was a search done. It will be search if one was done, otherwise it will be none.
            filter = $('#filter-type').val()
            // Check the export type
            if (export_type == 'csv') {
                // Check if a search was done
                if (filter == 'none') {
                    // Send them to the export_cvs page, they'll be sent back
                    window.location.href = "export_cvs.php";
                } else if (filter == 'search') {
                    // Get the search term
                    input = $('#filter-type').attr("data-search")
                    // Send them to the export_cvs_project_search page with the search term , they'll be sent back
                    window.location.href = "export_cvs_project_search.php?search=" + input;
                }

            } else if (export_type == 'excel') {
                // Check if a search was done
                if (filter == 'none') {
                    // Send them to the export_cvs_projects page, they'll be sent back
                    window.location.href = 'export_excel_projects.php';
                } else if (filter == 'search') {
                    // Get the search term
                    input = $('#filter-type').attr("data-search")
                    // Send them to the export_excel_project page with the search term , they'll be sent back
                    window.location.href = "export_excel_projects.php?search=" + input;
                }
            }
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
        // What happens if you click outside the add project modal
        $( "#outside_modal" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
            
        })
        // What happens if you click outside the edit project modal
        $( "#outside_modal_edit" ).click(function() {
            // Stop displaying myModal2
            $(document.getElementById('myModal2')).css('display','none');
            
        })
        // What happens if you click outside the edit project modal
        $( "#outside_modal_data" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('data_modal')).css('display','none');
            
        })

        //Make the DIV element draggagle, makes myModal draggable :
        dragElement(document.getElementById(("movable_add")));
        //Make the DIV element draggagle, makes myModal2 draggable :
        dragElement(document.getElementById(("movable_edit")));
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
    // ----- End document.ready -----


</script>


















<!-- Hidden Modals -->

<div class='main-container'>











<div id="data_modal" class="modal" style='background-color:transparent;'>
    <div id='outside_modal_data' style='background-color:transparent; display:block; z-index:5;' class='modal'></div>
    <!-- Modal content -->
    <div style='left:50%; margin-top:2%; position: absolute; margin-left:-350px;'>
        <div style='width:700px; height:230px; position:absolute; background-color:#fff;z-index:6;border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='movable_data'>
            
            <div id='movable_dataheader' style='cursor: move;height:40px;background-color: rgb(200, 200, 200);'>
                    <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Data For Projects</p>
            </div>

            <div style='margin-top:15px;height:30px;line-height:20px;'>
                <p style='float:left;margin-left:20px;padding:0;'>Total Projects</p>
                <p style='float:left' id='total_projects'></p>
            </div>
            <div style='height:30px;line-height:20px;'>
                <p style='float:left;margin-left:20px;padding:0;'>Total Time Entered To All Projects</p>
                <p style='float:left;'>
                <?php
                    echo ": ";
                    //Initalize total seconds to 0
                    $total_seconds = 0;
                    //Initalize total seconds to 0
                    $total_entries = 0;
                    // Get all projects from the company
                    $sql = "SELECT * FROM projects WHERE org_id = '$org_id' AND status = 'active';";
                    // Put the results into $result
                    $result = mysqli_query($conn, $sql);
                    // Go throught the results
                    while ($row = $result->fetch_assoc()) {
                        
                        $project_id = $row['project_id'];
                        
                        $sql = "SELECT * FROM timeGeneral WHERE project_id = '$project_id'";
                        // Put the results into $result2
                        $result2 = mysqli_query($conn, $sql);
                        // Go through the results
                        while ($row2 = $result2->fetch_assoc()) {
                            // Get the time
                            $time = $row2['time'];
                            // converts and adds the time into seconds
                            $array = explode(':', trim($time, ':'));
                            $total_seconds += intval($array[0]) * 3600;
                            $total_seconds += intval($array[1]) * 60;
                            $total_seconds += intval($array[2]);

                            $total_entries += 1;
                            
                        }
                    }
                    $hours = floor($total_seconds/3600);
                    $total_seconds = ($total_seconds - $hours * 3600);
                    $minutes = floor($total_seconds/60);
                    $seconds = ($total_seconds - $minutes * 60);
                    if ( $hours < 10) {
                        echo "0".$hours.":";
                    } else {
                        echo $hours.":";
                    }
                    if ( $minutes < 10) {
                        echo "0".$minutes.":";
                    } else {
                        echo $minutes.":";
                    }
                    if ( $seconds < 10) {
                        echo "0".$seconds;
                    } else {
                        echo $seconds;
                    }

                ?>
                </p>
            </div>
            <div style='height:30px;line-height:20px;'>
                <p style='float:left;margin-left:20px;padding:0;'>Total Entries In All Projects</p>
                <p style='float:left;'><?php echo ": "; echo $total_entries; ?></p>
            </div>
            <!-- <div style='height:30px;line-height:20px;'>
                <p style='float:left;margin-left:20px;padding:0;'>Total Entries In All Projects</p>
                <p style='float:left;'><?php echo ": "; echo $total_entries; ?></p>
            </div> -->

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

</div>



