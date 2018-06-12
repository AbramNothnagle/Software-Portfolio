<?php

    // Puts header in page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // If not, exit the code
        exit;
    }
    // Creates the database connection with variable $conn
    include 'includes/dbh.inc.php';
    // Check to see if a project was just deleted
    if (isset($_SESSION['just_deleted'])) {
        // Get the value 
        $result = $_SESSION['just_deleted'];
        // Check to see if it is set to true
        if ($result == 'true') {

            
            echo "
                <div class='disappear_modal' style='position:absolute;margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;top:80px;width:400px; height:50px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <p style=' margin-left:130px; line-height:50px;'>PROJECT DELETED</p>
                </div>
            ";
        }
        // Unset the session variable so it doesn't pop up another message
        unset($_SESSION['just_deleted']);
    }
    

?>
  
<!-- Main part of page -->
<section class="main-container">
    
    <?php
        // Puts the navigation in the page
        include_once 'nav.php';
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
                
            <!-- Search form to search projects -->
            <!-- <form method='GET' > -->
                <button id='project-search' type='submit' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                font-size: 16px;' >Search</button>
                <input id='search-input' placeholder='Search projects'type='text' name='search' style='padding: 0px 0px 0px 12px;float:right;width:30%;height:37px;margin-top:20px; margin-right:20px; font-size:16px;'>
            <!-- </form> -->
         
            <!-- Button to add new projects -->
            <button id='add_button' class='button-style-1' style ='color:#fff;line-height:40px;'>
                Add Project
            </button>
            
            
            <button id='all_button' class='button-style-3' style='width:60px;color:white;'>
                All
            </button>
            

            </div>
        </div>


        <div class='box-create' style='width:100%; height:60px; margin-top:0px; background-color:rgb(247, 247, 247)'>  
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
                    <option value='excel'>excel</option>
                    <option value='pdf'>pdf</option>
                </select>

                <!-- <button id='data_button' type='submit' name='commentSubmit' 
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
                </button> -->

            </div>
        </div>

        <!-- 3rd row: 1 button -->
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
                    <option>Alphabetical</option>
                </select>
            </div>

            <div>
                <h5 style='float:right; margin-right:20px; line-height:74px;'> sort by: </h5>
            </div>
        </div>
        <!-- 3rd row end -->
        




        <!-- Begin PHP code -->
        <?php
            // Puts in a style_now style sheet
            echo '<link rel="stylesheet" type="text/css" href="style_now.css">';
            // Get the company id
            $org_id = $_SESSION['u_org_id'];

            // // Start the list div that contains results
            echo "<div id='list'>";

            echo "</div>";
            // ----- End list div -----

        ?>
        <!-- End php code -->

    </div>
</section>
<!-- End main part of page -->












<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
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
        $.post('load_projects_to_objects.php', function(result) {
            // Turn the result into JSON objects
            project = JSON.parse(result)
            // Save the original object order
            project_original = project
            // Display all of these projects at the start of page
            display_all()
        })

        // Function to display all of the entries
        function display_all() {
            // Clear all projects
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < project.length; i++) {
                // Get the html for the entry
                text = prepare_entry_line(project[i].project_name, project[i].id, project[i].description, project[i].date, project[i].job_code)
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
                if ( project[i].project_name.toLowerCase().includes(input.toLowerCase()) ) {
                    // Get the html for the entry
                    text = prepare_entry_line(project[i].project_name, project[i].id, project[i].description, project[i].date, project[i].job_code)
                    // Put the entry on #list
                    var entry = $('#list').append(text)
                }
            }
        }

        // Create the entry lines with html
        function prepare_entry_line(project_name, id, description, date, job_code) {
            // Create the text needed to create an entry
            text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> Project Name: " + project_name + "</div><form style='position:relative; margin-left:47%;' method='GET' action='viewHours.php'><input type='hidden' name='project_id' value=" + id + "><button style='float:right; margin-top:11px;' class='box-button2' type ='submit'>Select Project</button></form><button type='button' data-jobcode='" + job_code + "' data-project='" + project_name + "' data-date='" + date + "' data-description='" + description + "' value=" + id + " class='box-button entry-button-style-1 time_id' name='time_id' style=' width: 120px;'>Edit</button></div></div>";
            // Return the text
            return text
        }

        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            
            // Check the sorting type is alphabetical
            if ($('#sorting').val() == 'Alphabetical') {
                // Sort alphabetically
                project = merge_alphabetical_project_name(project)
                // Check if they are searching
                if (searching == false) {
                    // Display every project
                    display_all()
                } else {
                    // Display the projects with the search term in them
                    display_search()
                }
            // Check if the sorting type is none
            } else if ($('#sorting').val() == 'Date Created') {
                // Set to orignal order
                project = project_original
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
            // Set searching to false
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

        // What happens if the cancel button on the editing project modal (myModal2) is clicked
        $( "#cancel_edit" ).click(function() {
            // Stop displaying myModal2
            $(document.getElementById('myModal2')).css('display','none');
            
        })

        // What happens if the save button on the editing project modal (myModal2) is clicked
        $( "#save_edit" ).click(function() {
            // Get the new project name
            project_name = $("#project_name_edit").val()
            // Check to make sure the project name is not empty
            if (project_name != '') {
                // Set the valid characters
                var letterNumber = /^[0-9a-zA-Z\s]+$/;
                // Check to make sure they use only letters and numbers in the project name
                if (project_name.match(letterNumber)) {
                    // Stop displaying myModal2
                    $(document.getElementById('myModal2')).css('display','none');
                    // Set project_edit
                    project_edit = 'set'
                    // Get the project id
                    project_id = $("#project_id").val()
                    // Get the new date
                    date = $("#date_edit").val()
                    // Get the new description
                    description = $("#description_edit").val()
                    // Get the new job code
                    job_code = $("#job_code_edit").val()
                    // Put the new info into the database
                    $.post('edit_project_info.php', {project_edit:project_id,project_id:project_id, project_name:project_name,date:date,description:description, job_code:job_code})
                    // Go through all the project objects
                    for (var i = 0; i < project.length; i++) {
                        // Check if the project
                        if (project[i].id === project_id) {
                            // Update the project object name
                            project[i].project_name = project_name;
                            // Update the project object date
                            project[i].date = date;
                            // Update the project object description
                            project[i].description = description;
                            // Update the project job code
                            project[i].job_code = job_code;
                            // Leave the i for loop
                            break;
                        }
                    }
                    // Check if they are searching
                    if (searching == false) {
                        // Display every project
                        display_all()
                    } else {
                        // Display the projects with the search term in them
                        display_search()
                    }
                } else {
                    // Let the user know they need valid characters
                    alert("You can only use letters, numbers, and spaces in the project name.")
                }
            } else {
                // Let the user know that their project needs a name
                alert('Your project must at least have a name.')
            }
        })

        // What happens click the save button on the add project modal
        $( "#save_project" ).click(function() {
            // Get the project name
            project_name = $("#project_name").val()
            // Check to make sure the project name is not empty
            if (project_name != '') {
                // Set project_save
                project_save= 'set'
                // Get the project name
                project_name = $("#project_name").val()
                // Get the date
                date = $("#date").val()
                // Get the description
                description = $("#description").val()
                // Get the job code
                job_code = $("#job_code").val()
                // Put the new info into the database
                $.post('save_project_info.php', {project_save:project_save,project_name:project_name,date:date,description:description, job_code:job_code}, function(result){        
                    // Create a new project object
                    project_new = {id:result,project_name:project_name,date:date,description:description, job_code:job_code}
                    // Put the object into the JSON
                    project.push(project_new)
                    // Display all the entries
                    if (searching == false) {
                        // Display every project
                        display_all()
                    } else {
                        // Display the projects with the search term in them
                        display_search()
                    }
                })
                // Stop displaying myModal
                $(document.getElementById('myModal')).css('display','none');  
            } else {
                // Let the user know that their project needs a name
                alert('Your project must at least have a name.')
            }
        })


        $("#export").click(function() {
            // Get the chosen export type
            export_type = $('#export-type').val()
            // Gets if there was a search done. It will be search if one was done, otherwise it will be none.
            //filter = $('#filter-type').val()
            // Check the export type
            if (export_type == 'csv') {

                // Convert JSON to CSV 
                csvFirstLine = 'Id, Date, Description, Project Name, Job Code\r\n'
                
                if (searching == false) {
                    csvContent = ConvertToCSV(project)
                } else {
                    csvContent = ConvertToCSV_search(project)
                }

                csvContent = csvFirstLine + csvContent

                var blob = new Blob([csvContent]);
                if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
                    window.navigator.msSaveBlob(blob, "projects_data.csv");
                else
                {
                    var a = window.document.createElement("a");
                    a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
                    a.download = "projects_data.csv";
                    document.body.appendChild(a);
                    a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
                    document.body.removeChild(a);
                }
            

            } else if (export_type == 'excel') {
                // Convert JSON to CSV 
                csvFirstLine = 'Id, Date, Description, Project Name, Job Code\r\n'
                
                if (searching == false) {
                    csvContent = ConvertToCSV(project)
                } else {
                    csvContent = ConvertToCSV_search(project)
                }

                csvContent = csvFirstLine + csvContent

                var blob = new Blob([csvContent]);
                if (window.navigator.msSaveOrOpenBlob)  // IE hack; see http://msdn.microsoft.com/en-us/library/ie/hh779016.aspx
                    window.navigator.msSaveBlob(blob, "projects_data.xls");
                else
                {
                    var a = window.document.createElement("a");
                    a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
                    a.download = "projects_data.xls";
                    document.body.appendChild(a);
                    a.click();  // IE: "Access is denied"; see: https://connect.microsoft.com/IE/feedback/details/797361/ie-10-treats-blob-url-as-cross-origin-and-denies-access
                    document.body.removeChild(a);
                }

            }
        })

        // JSON to CSV Converter
        function ConvertToCSV(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';

            for (var i = 0; i < array.length; i++) {
                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','

                    line += array[i][index];
                }

                str += line + '\r\n';
            }

            return str;
        }
        // JSON to CSV Converter
        function ConvertToCSV_search(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';

            for (var i = 0; i < array.length; i++) {
                if ( array[i].project_name.toLowerCase().includes(input.toLowerCase()) ) {
                    var line = '';
                    for (var index in array[i]) {
                        if (line != '') line += ','

                        line += array[i][index];
                    }

                    str += line + '\r\n';
                }
            }

            return str;
        }


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


    // What happens when an edit button on one of the projects in clicked
    $('#list').on('click', '.box-button' , function(){
        // Display the myModal2 modal
        $(document.getElementById('myModal2')).css('display','block');
        // Get the id of the edited project
        clicked_project_id = $(this).val();
        // Get the name of the edited project
        clicked_project_name = $(this).attr("data-project");
        // Get the date of the edited project
        clicked_project_date = $(this).attr("data-date");
        // Get the job code of the edited project
        clicked_project_jobcode = $(this).attr("data-jobcode");
        // Get the description of the edited project
        clicked_project_description = $(this).attr("data-description");
        // Get the first 10 characters of the clicked_project_date string
        format_date = clicked_project_date.slice(0, 10);
        // Prefill the edit project modal with the current name
        $("#project_name_edit").val(clicked_project_name)
        // Prefill the project with the current chosen date
        $("#date_edit").val(format_date)
        // Put the projects id into the form needed to update the project
        $("#project_id").val(clicked_project_id)
        // Prefill the project the current description
        $("#description_edit").val(clicked_project_description)  
        // Prefill the project the current description
        $("#job_code_edit").val(clicked_project_jobcode) 
    })


</script>

















<!-- Hidden Modals -->
<div class='main-container'>


    <!-- Modal that comes up when add project is clicked -->
    <div id="myModal" class="modal" style='background-color:transparent;'>
        <div id='outside_modal' style='background-color:transparent; display:block; z-index:5;' class='modal'></div>
        
        <!-- Modal content -->
        <div style='left:50%; margin-top:10%; position: absolute; margin-left:-350px;'>
            <div style='width:700px; height:370px;position:absolute; background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='movable_add'>
            
                <div id='movable_addheader'style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                    <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Add New Project</p>
                </div>

                <div style='height:50px;'>
                    <p style='float:left;margin-left:20px;padding:0;'>Enter Project Name</p>
                </div>

                
                <div style='height:20px;'>
                    <input id='project_name' name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60%;' type=text id='start_submit'>
                <button style='float:right; margin-right:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
            
                        cursor: pointer;'>Options</button>
                </div>

                <div style='height:50px; margin-left:20px;'>
                    <p style='float:left;padding:0'>Date Start</p>
                </div>

                <div style='height:20px; margin-left:20px;'>
                    
                        <input id='date' type='date' name='date' style='margin-top:-15px;float:left;width: 300px;height: 30px;'>
                    
                        <button id='save_project' type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                            margin-top:-15px;
                            height: 34px;
                            border: none;
                            background-color: rgb(66, 85, 252);
                            font-family: arial;
                            color: #fff;
                            font-size: 14px;
                            cursor: pointer;'>Save
                        </button>
                    
                    <button id='cancel' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Cancel</button>
                </div>
                <div style='height:20px; margin-left:20px;'>
                    <p style='float:left;padding:0;'>Description</p>
                </div>

                <div style='height:50px; margin-left:20px;'>
                    <textarea id='description' style='width:656px;float:left; height:60px; margin-top:-15px; '></textarea>
                </div>

                <div style='height:20px; margin-left:20px;'>
                    <p style='float:left;padding:0;'>Job Code</p>
                </div>
                
                <div style='height:50px; margin-left:20px;margin-top:70px;'>
                    <input type='text' id='job_code' style='float:left;width: 300px;height: 30px;margin-top:-25px;'>
                </div>

            </div>
        </div>
    </div>








    <!-- Modal When edit button on a project is clicked -->
    <div id="myModal2" class="modal" style='background-color:transparent;'>
        <div id='outside_modal_edit' style='background-color:transparent; display:block; z-index:5;' class='modal'></div>
        <!-- Modal content -->
        <div style='left:50%; margin-top:10%; position: absolute; margin-left:-350px;'>
            <div style='width:700px; height:370px;position:absolute; background-color:#fff;z-index:6;border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' id='movable_edit'>
            
                <div id='movable_editheader'style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                    <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Edit Project</p>
                </div>

                <!-- Top Bar -->
                <div style='height:50px;'>
                    <p style='float:left;padding:0;margin-left:20px;'>Enter Project Name</p>
                </div>

                
                <div style='height:20px;'>
                    <input form ='edit_form' id="project_name_edit" name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60%;' type=text id='start_submit'>
                    <button style='float:right; margin-right:20px;width: 100px;
                            margin-top:-15px;
                            height: 34px;
                            border: none;
                            background-color: rgb(218, 218, 218);
                            font-family: arial;
                            color: #fff;
                            font-size: 14px;
                            cursor: pointer;'>Options</button>
                </div>

                <div style='height:50px; margin-left:20px;'>
                    <p style='float:left;padding:0'>Date Start</p>

                </div>
                <div style='height:20px; margin-left:20px;'>  
                    <input type='date' id='date_edit' name='date' style='margin-top:-15px;float:left;width: 300px;height: 30px;'>
                    <input type='hidden' value='' name='pid' id='project_id'>
                    <button id='save_edit' name='project_edit' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(66, 85, 252);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Save</button>
                    <button id='cancel_edit' style='float:left; margin-left:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Cancel</button>
                </div>
                <div style='height:20px; margin-left:20px;'>
                    <p style='float:left;padding:0'>Description</p>
                </div>
                <div style='height:50px; margin-left:20px;'>
        
                    <textarea id='description_edit' name='description_edit' style='width:656px; float:left; height:60px; margin-top:-15px; '></textarea>
                </div>


                <div style='height:20px; margin-left:20px;'>
                    <p style='float:left;padding:0;'>Job Code</p>
                </div>
                
                <div style='height:50px; margin-left:20px;margin-top:70px;'>
                    <input id='job_code_edit' type='text' name='job_code_edit' style='float:left;width: 300px;height: 30px;margin-top:-25px;'>
                </div>
            </div>
        </div>
    </div>





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
                    <p style='float:left'><?php 
                        // Get all projects from the company
                        $sql = "SELECT * FROM projects WHERE status = 'active' AND org_id = '$org_id'";
                        // Put the results into $result
                        $result = mysqli_query($conn, $sql);
                        // Get the number of projects found
                        $total_projects = mysqli_num_rows($result);
                
                        echo ": "; echo $total_projects; ?></p>
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
                            // Get the project id
                            $project_id = $row['project_id'];
                            // Get entries from that project
                            $sql = "SELECT * FROM timeGeneral WHERE project_id = '$project_id' AND status = 'active';";
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




