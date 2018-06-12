<?php
    // Put the header in the page
    include_once 'header.php';
    // Creates database connection
    include 'includes/dbh.inc.php';
    // Checking to see if the page the user came from sent information about the employee they want to view
    if (isset($_GET['emp_id'])) {
        // Get the company id
        $org_id = $_SESSION['u_org_id'];
        // Get the employee id
        $emp_id = $_GET['emp_id'];
        // Check to make sure this employee id is from their company
        $sql2 = "SELECT * FROM employees WHERE emp_id = '$emp_id' AND emp_org = '$org_id';";
        // Put result in to $result2
        $result2 = mysqli_query($conn, $sql2);
        // Get the number of results
        $resultCheck = mysqli_num_rows($result2);
        // Check if there were any results
        if ($resultCheck == 0) {
            // Send them to the home page
            exit;
        }
        // put emp_id into session variable 'current_emp_id'
        $_SESSION['current_emp_id'] = $_GET['emp_id'];
        // Get the employee
        $sql = "SELECT * FROM employees WHERE emp_id = '$emp_id' AND emp_org = '$org_id';";
        // Put the result into $result list
        $result = mysqli_query($conn, $sql);
        // Go through results
        while ($row = $result->fetch_assoc()) {
            // Set a session for emp last
            $_SESSION['current_emp_first'] = $row['emp_first'];
            // Set a session for emp first
            $_SESSION['current_emp_last'] = $row['emp_last'];
        }
    }
    //!!!
    // put emp_id into $emp_id
    $emp_id = $_SESSION['current_emp_id'];//where does this come from if no POST information set?
    // put emp_first into $emp_first
    $emp_first = $_SESSION['current_emp_first']; //where does this come from if no POST information set?
    //Maybe we should have error handling for this, just in case
    //Or use Get method
     



?>

<!-- Add the style sheet style_now to the page -->
<link rel="stylesheet" type="text/css" href="style_now.css">

<!-- Main part of page -->
<section class="main-container">

    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>

    <!-- main wrapper -->
    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>
        
        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <!-- Display employee's first and last name from current session variables -->
                <h4><?php echo $_SESSION['current_emp_first']. ' ' . $_SESSION['current_emp_last']; ?></h4>
                <button id='delete_employee' class='delete_button_can'>D</button>
            </div>
        </div>

        <!-- Top row or 1st row 60px: 2 buttons 1 hidden button 1 dropdown menu 
        1 filter button
        1 employee calendar button
        1 filter dropdown-->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>

                <!-- Creates the filter button
                id: filter-button 
                name: commentSubmit-->
                <button id ='filter-button' name='commentSubmit' class='button-style-2'>
                    <a style ='color:#fff;' >Filter</a>
                </button>

                <!-- Creates the drop down to select filter type
                sets filter type to: all, day, month, or year
                id: filter-type -->
                <select id='filter-type' class='dropdown-style-1' style='float:right;'>
                    <option>all</option>
                    <option>day</option>
                    <option>week</option>
                    <option>month</option>
                    <option>year</option>
                    <option>pay period</option>
                </select>

                <!-- Creates the button to go to the employee's calendar
                link to employeeshift.php -->
                <a class='button-style-2' style ='color:#fff; float:left; line-height:40px;' href='employeeshift.php'>Calendar</a>


                <!-- The all button to see all employee's entries 
                id: all_button
                name: commentSubmit-->
                <button id='all_button' name='commentSubmit' class='button-style-3'>
                    All
                </button>
            </div>
        </div>   
        <!-- End 1st row -->


        <!-- 2nd row 120px: 2 buttons 1 dropdown menu -->
        <!-- Export button, export type dropdown, delete selected entries button -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Creates the button to export page's data to a selected type -->
                <!-- id: export, name: delete3 -->
                <button id='export' type='submit' class='button-style-2' name='delete3' style='background-color: rgb(194, 194, 194);'>
                    Export
                </button>

                <!-- Creates dropdown menu to select export type -->
                <!-- id: export-type -->
                <select id='export-type' class='dropdown-style-1' style='float:right;'>
                    <option>csv</option>
                    <!-- <option>excel</option>
                    <option>pdf</option> -->
                </select>

                <!-- Creates the button to delete selected entries if pressed -->
                <!-- id: delete_selected, name: delete2 -->
                <button type='submit' id='delete_selected' class='button-style-2' form='delete_selected' name='delete2' style='float:left;background-color: rgb(194, 194, 194);'>
                    Delete Selected
                </button>
            </div>
        </div> 
        <!-- End 2nd row -->

        <!-- 3rd row: 1 button , 1 dropdown menu-->
        <div class='box-create' style='width:100%; height:150px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>
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
                    <option>none</option>
                    <option>date</option>
                    <option>alphabetical</option>
                    <option>length</option>
                </select>
            </div>
        </div>
        <!-- 3rd row end -->


        <!-- Creates arrow buttons for filtering dates. Hidden until filter used -->
        <div style ='display:none; height:54px; margin-top:-54px; background-color:rgb(247, 247, 247);width:100%;'id='filter-date-slide' class='search-results'>
            <div style='float:left; margin-top:-3px; margin-left:24%;'>
                <button class='arrow-button' id='time-back' style=''><p class='fa fa-chevron-left'></p>
                </button>
            </div>
            <div style='float:right; margin-top:-3px; margin-right:24%;'>
                <button class='arrow-button' id='time-forward' style=''><p class='fa fa-chevron-right'></p>
                </button>
            </div>

            <div style='float:left; margin-left:4%;'>
                <input id='start-display' style='height:30px;width:150px;font-size:12px;' type='date'>
            </div>
            <div style='float:left; margin-left:1%;'><p>to:</p></div>
            <div style='float:right; margin-right:3%;'>
                <input id='end-display' style='height:30px;width:150px;font-size:12px;' type='date'>
            </div>
        </div>


        <!-- Begin List Div that lists all of the entries from the employee -->
        <!-- id: list -->
        <div id='list'>

        <!--php code-->
        <?php
            // // Start total_seconds to 0
            // $total_seconds = 0;
            // // Get the current company name 
            // $org_id = $_SESSION['u_org_id'];
            // // Get all the sumbitted entries of the employee
            // $sql = "SELECT * FROM timeGeneral WHERE submitted = 'yes' AND emp_id = '$emp_id';";
            // // Put the result into $result list
            // $result = mysqli_query($conn, $sql);

            // // ----- Create the entry lines -----
            // while ($row = $result->fetch_assoc()) {
                      
            //     //run create_employee_entry.php to display each entry on screen
            //     include 'create_employee_entry.php';
    
            // }
            // ------ End line entries ------
        ?>
        <!-- php code end -->

        </div>
        <!-- End list Div -->

        <!-- Area for the button to add more entries to project -->
        <div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>
            <div id='assign_project_box' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;'>
                
                <button id='add_entry'style='cursor:pointer;width: 100%; height:50px;
                    margin:0 auto;
                    background-color: rgb(218, 218, 218);
                    border-radius: 4px;font-size:16px; '>
                    + ADD ENTRY
                </button>
            
            </div>
        </div>

             <!-- shows the total time of the entries -->
            <div class='timeStyle' style='font-size:24px;padding: 2px; margin:0 auto; background-color:#cbcbcb;width:200px; border:2px;border-radius:4px;border-style: outset; height:30px; margin-top:10px; line-height:30px;'>
                <p id='total_time' style='    color: #b2b2b2;
                    background-color: #cbcbcb;
                    letter-spacing: .1em;
                    font-weight: 900;
                    text-align: center;
                    text-shadow:
                    -1px -1px 1px #7f7f7f,
                    2px 2px 1px #e5e5e5;'>
                    
                    <!-- php code -->
                    <?php

                    $hours = floor($total_seconds/3600); //total number of hours (round down to get whole hours)
                    $total_seconds = ($total_seconds - $hours * 3600); 
                    $minutes = floor($total_seconds/60); //total number of minutes not including hours
                    $seconds = ($total_seconds - $minutes * 60); //total number of seconds not including hours or minutes
                    //display and format time
                    //0x:--:-- format
                    if ( $hours < 10) {
                        echo "0".$hours.":";
                    } 
                    //xx:--:-- format
                    else {
                        echo $hours.":";
                    }
                    //--:0X:-- format
                    if ( $minutes < 10) {
                        echo "0".$minutes.":";
                    } 
                    //--:xx:-- format
                    else {
                        echo $minutes.":";
                    }
                    //--:--:0x format
                    if ( $seconds < 10) {
                        echo "0".$seconds;
                    } 
                    //--:--:xx format
                    else {
                        echo $seconds;
                    }
                    ?> 
                    <!-- end php code --> 
                </p>
            </div>



        <!-- <form method="POST" name='delete_selected' id='delete_selected'>
            </form>   -->

        <!-- php code -->
        <!-- delete selected event handling -->
        <?php
        
        //print to screen form for editTimeGeneral
        echo "<form id='edit' method='POST' action='editTimeGeneral.php'></form>";
        
        //if delete selected button was pressed
        //(e.g. if delete2 button was pressed)
       if (isset($_POST['delete2'])){
           
           $box = $_POST['num'];
           //run through all selected entries with while loop
           while (list ($key, $val) = @each ($box)){ 
               //delete each selected entry
               mysqli_query($conn, "DELETE FROM timeGeneral WHERE time_id = $val");
           }
           ?>
           <!-- break php code for javascript -->
                <!-- !!! -->
               <script type="text/javascript"> //what does this do?
                    window.location.href=window.location.href;
               </script>

           <?php
       }
        
       ?>
       <!-- end php code -->



</section>
<!-- End main part of page -->







<!-- !!! -->
<!-- should list what each of these does -->
<!-- Gets the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Gets jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Gets jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Gets merge functions -->
<script src="merge_sorting_functions.js"></script>
<!-- Add a moment format -->
<script src="duration_format.js"></script>

<!-- start javascript -->
<script>

    $(document).ready(function() {
                
        var clicked_project_id;
        //get current date and time
        var date = moment();
        var type = 'none';
        var date_format;
        // Default filter_date to false
        var filter_date = false;
        // Create moment object for latest entry to be shown
        var date_end = moment();


        //set data as current data in YYYY-MM-DD format
        $('#date').val(moment().format('YYYY-MM-DD'));
        var emp_load = 'set'


        // Get all of the entries from the project
        $.post('load_employee_entries_to_objects.php', {emp_load:emp_load}, function(result) {
            // Turn the result into JSON objects
            entries = JSON.parse(result)
            // Display all of these entries at the start of page
            display_all()
        })

        // Create the entry lines with html
        function prepare_entry_line(project_name,date,time,id,start,startdiem,end,enddiem,description) {
            // Create the text for the entry
            text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> Project Name: " + project_name + " | Date: " + date + " | Time: " + time + "</div><label style = 'margin-top:10px; float:right; margin-right:15px;' class='checkbox-container'><input class='entry_check' type='checkbox' name='num[]' value='" + id + "'><span class='checkmark'></span></label><button type='submit' value='" + id + "' class='info_button_managetime entry-button-style-1' name='time_id'>Info</button><button type='button' data-start='" + start +"' data-startdiem ='" + startdiem + "' data-end='" + end +"' data-enddiem='" + enddiem + "' data-date='" + date + "' data-description='" + description + "' value='" + id + "' class='edit entry-button-style-1 time_id' name='time_id' style=' width: 60px;'>Edit</button></div></div>";
            // Return the text
            return text
        }
        
        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            
            if ($('#sorting').val() == 'alphabetical') {
                

                entries = merge_alphabetical_project_name(entries)

                if ( filter_date == false){
                    
                    display_all()
                } else {
                    date_compare()
                }


            } else if ($('#sorting').val() == 'date'){

            
                entries = merge_date(entries)
                if ( filter_date == false){
                 
                    display_all()
                } else {
                    date_compare()
                }
                

                            
            } else if ($('#sorting').val() == 'length'){

                entries = merge_length(entries)
                if ( filter_date == false){
                    display_all()
                } else {
                    date_compare()
                }



            } else if ($('#sorting').val() == 'none') {
                alert("here")
            }
        })

        // Function to display all of the entries
        function display_all(){
            // Clear all entries
            $('#list').html('')
            // Create moment duration to add up total time
            total_time = moment.duration()
            // Go through every entry
            for (i = 0; i < entries.length; i++) {
                // Get the html for the entry
                text = prepare_entry_line(entries[i].project_name,entries[i].date ,entries[i].time, entries[i].id, entries[i].start,entries[i].startdiem,entries[i].end,entries[i].enddiem ,entries[i].description)
                // Put the entry on #list
                var entry = $('#list').append(text)
                // Create time entry object
                entry_time = moment.duration(entries[i].time)  
                // Add to the total time
                total_time.add(entry_time) 
            }
            // Put the total time at the bottum
            $('#total_time').html(total_time.format('HH:mm:ss'))
        }

        // Creates entries based on if they fall inbetween two dates. date and date_end are the moment objects
        function date_compare() {
            // Clear out the entries
            $('#list').html('')
            // Create moment duration to add up total time
            total_time = moment.duration()
                
            for (i = 0; i < entries.length; i++) {
                if (moment(entries[i].date).unix() >= date.unix() && moment(entries[i].date).unix() < date_end.unix()) {
                    // Get the html for the entry
                    text = prepare_entry_line(entries[i].project_name ,entries[i].date ,entries[i].time, entries[i].id, entries[i].start,entries[i].startdiem,entries[i].end,entries[i].enddiem ,entries[i].description)
                    // Put the entry on #list
                    var entry = $('#list').append(text)
                    // Create time entry object
                    entry_time = moment.duration(entries[i].time)  
                    // Add to the total time
                    total_time.add(entry_time) 
                }
            }
            // Put the total time at the bottum
            $('#total_time').html(total_time.format('HH:mm:ss'))
        }


        // What happens if the filter button is clicked
        $( "#filter-button" ).click(function() {
            
            filter_date = true;

            // Gets what filter type the user selected
            //all, day, month, or year
            type = $('#filter-type').val()

            

            // If the type was 'all' the page is refreshed
            switch (type) { //should use switch statement
             
            case 'all': 
                // Refreshes page
                location.reload();
                break;
            
            // What happens if the type was year
            case 'year':
                $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
                date_compare()
                break;
            
            // What happens if the type was month
            case 'month':
                $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
                date_compare()
                break;

            // What happens if the type was month
            case 'week':
                $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
                date_compare()
                break;
            
            // What happens if the type was day
            default:
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
                date_compare()
                break;
            }
            // Load what is found for that date into the #search-results div
            $(document.getElementById('filter-date-slide')).css('display','block')
        })

        // What happens if the arrow forward on the time filter is clicked
        $( "#time-forward" ).click(function() {  
            
            if (type=='year') {
                date.add(1, 'years').calendar();
                date_end.add(1, 'years').calendar();
                year()
                date_compare()
            } else if (type=='month') {
                date.add(1, 'months').calendar();
                date_end.add(1, 'months').calendar();
                month()
                date_compare()
            } else if (type=='week') {
                date.add(7, 'days').calendar();
                date_end.add(7, 'days').calendar()
                week()
                date_compare()
            } else if (type=='day') {
                date.add(1, 'days').calendar();
                date_end.add(1, 'days').calendar();
                day()
                date_compare()
            }
        })

        // What happens if the arrow backward on the time filter is clicked
        $( "#time-back" ).click(function() {
            if (type=='year') {
                date.subtract(1, 'years').calendar();
                date_end.subtract(1, 'years').calendar();
                year()
                date_compare()
            } else if (type=='month') {
                date.subtract(1, 'months').calendar();
                date_end.subtract(1, 'months').calendar();
                month()
                date_compare()
            } else if (type=='week') {
                date.subtract(7, 'days').calendar();
                date_end.subtract(7, 'days').calendar();
                week()
                date_compare()
            } else if (type=='day') {
                date.subtract(1, 'days').calendar();
                date_end.subtract(1, 'days').calendar();
                day()
                date_compare()
            }
        })
        function year(){

            $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
            $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
            date_format = date.format('YYYY');
        }
        function month(){

            $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
            $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
            date_format = date.format('YYYY-MM');
        }
        function week() {

            $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
            $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
            date_format = date.format('YYYY-MM-DD');
        }
        function day(){
    
            $(document.getElementById('start-display')).val(date.startOf('day').format('YYYY-MM-DD'))
            $(document.getElementById('end-display')).val(date_end.endOf('end').format('YYYY-MM-DD'))
            date_format = date.format('YYYY-MM-DD');        

        }

        // What happens if the date is changed on the custom start calendar
        $('#start-display').change(function() {
            if ( moment($('#start-display').val()).unix() < date_end.unix()) {
                date = moment($('#start-display').val())
                
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
                date_compare()
            } else {
                alert("Your start date is later than your end date.")
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
            }
            
        })
        // What happens if the date is changed on the custom end calendar
        $('#end-display').change(function() {
            if ( date.unix() < moment($('#end-display').val()).unix()) {
                date_end = moment($('#end-display').val())
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
                date_compare()
            } else {
                alert("Your start date is later than your end date.")
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            }
        })

        // What happens if you click the export button
        $("#export").click(function() {
            //get export type from dropdown menu
            export_type = $('#export-type').val()
            //default to not filtered
            filtered = false;
            //in if-else loops, determine what happens for each export type
            if (export_type == 'cvs') {
                //export if not filtered
                if (filtered == false) {
                    window.location.href = "export_cvs_employee_entries.php";
                } else {
                    //window.location.href = "export_cvs_project_search.php?search=" + input;
                }
            }
        })

        // What happens when one of the edit buttons is clicked on a project
        $(".edit").click(function() {
            //set all values
            $(document.getElementById('myModal')).css('display','block')
            $('#tid').val($(this).val()) 
            $('#date_edit').val($(this).attr("data-date"))
            $('#description_edit').val($(this).attr("data-description"))
            $('#start_edit').val($(this).attr("data-start"))
            $('#end_edit').val($(this).attr("data-end"))
            $('#start_diem_edit').val($(this).attr("data-startdiem"))
            $('#end_diem_edit').val($(this).attr("data-enddiem"))
        })
        // What happends if the cancel button is clicked on a project
        $( "#cancel_edit" ).click(function() {
            $(document.getElementById('myModal')).css('display','none');
        })
        // What happends if the save button is clicked on a project
        $( "#save_edit" ).click(function() {
            // Get the date that was entered
            date_for_edit = $('#date_edit').val()
            // Make sure they enter a date
            if (date_for_edit != '') {     
                // Get the entered start time    
                start = $('#start_edit').val()
                // Get the entered end time
                end = $('#end_edit').val()
                // Get the chosen AM/PM for start
                start_diem = $('#start_diem_edit').val()
                // Get the chosen AM/PM for end
                end_diem = $('#end_diem_edit').val()
                // Make sure the start time is a valid time
                if (moment(date_for_edit+" "+start+" "+start_diem).isValid()) {
                    // Make sure the end time is a valid time
                    if (moment(date_for_edit+" "+end+" "+end_diem).isValid()) {
                        // Check to make sure the end time is later than the start time
                        if (moment(date_for_edit+" "+start+" "+start_diem).unix() < moment(date_for_edit+" "+end+" "+end_diem).unix()) {
                            // Get the length of the entry
                            time = moment.duration(moment(date_for_edit+" "+end+" "+end_diem).diff(moment(date_for_edit+" "+start+" "+start_diem))).format('HH:mm:ss')
                            // Get the id of the entry being edited
                            time_id = $('#tid').val() //time id
                            emp_id = $('#emp_id').val() //employee id
                            description = $('#description_edit').val() //entered description
                            // Update the database
                            $.post('edit_entry_to_employee.php', {date:date_for_edit,start:start,end:end,start_diem:start_diem,end_diem:end_diem,emp_id:emp_id,description:description,time_id:time_id}, function(){
                                
                                for (var i = 0; i < entries.length; i++) {
                                    
                                    if (entries[i].id === time_id) {
                                        
                                        entries[i].date = date_for_edit;
                                        entries[i].time = time;
                                        entries[i].start = start;
                                        
                                        entries[i].startdiem = start_diem;
                                        entries[i].end = end;
                                        entries[i].enddiem = end_diem;  
                                          
                                        entries[i].description = description;
                                        if ( filter_date == false){
                                            display_all()
                                        } else {
                                            date_compare()
                                        }
                                        
                                    }
                                }
                            });                 
                            $(document.getElementById('myModal')).css('display','none');
                        } else {
                            alert("Your start time is later than your end time.")
                        }
                    } else {
                        alert("Your end time is not a valid time")
                    }
                } else {
                    alert("Your start time is not a valid time.")
                }
            } else {
                alert("You must enter a date.");
            }
            

        })
        //!!!
        //If manage time button is clicked
        $( ".info_button_managetime" ).click( function() {
    
            time_id = $(this).val();
            //load entry info
            $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
            //display as a modal
            $("#info_modal").css("display","block");
            
        });
        // What happens if the exit_data button is clicked
        $( "#exit_data" ).click( function() {
            // Stop displaying the info_modal
            $("#info_modal").css("display","none");
            
        });
        // What happens when you click the add_entry button
        $( "#add_entry" ).click( function() {
            // Display the add_entry_modal modal
            $("#add_entry_modal").css("display","block");
        });
        // What happens when you click the cancel_add_entry button
        $( "#cancel_add_entry" ).click( function() {
            // Stop displaying the add_entry_modal
            $("#add_entry_modal").css("display","none");
        });
        // What happens when you click the cancel_add_entry button
        $( "#delete_selected" ).click( function() {
            
            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                return checkbox.value;
            })
            // Set delete_set to set to show a proper submission
            var delete_set = "set";
            // Delete the entries from the database
            $.post('deleted_selected_entries.php', {arr:arr,delete_set:delete_set}, function() {
                // Go through the array of selected entries
                for (i = 0; i < arr.length; i++) {
                    // Go through entries
                    for (j = 0; j < entries.length; j++) {
                        // Find the entry with the same value
                        if (arr[i] == entries[j].id) {
                            // Remove the entry
                            entries.splice(j, 1);
                            // Leave the j for loop
                            break;
                        }
                    }
                }
                // Check if they are filtering dates
                if ( filter_date == false){
                    // If not, display all entries
                    display_all()
                } else {
                    // If so, display in that date range
                    date_compare()
                }
            });
        });

        // What happens when you click the delete employee button
        $( "#delete_employee" ).click( function() {
            var check = confirm("Are you sure you want to DELETE this employee? (Can be recovered) You will no longer be charged for it.")
            employee_delete = 'yes';
            if (check == true){
                $.post('delete_employee.php',{employee_delete :employee_delete}, function(){
                    window.location.replace('http://localhost/phplessons/view_employees.php')
                })
                
            }
        });

        // What happens if the add_entry button is clicked
        $( "#save_new_entry" ).click( function() {
            // Get the selected date
            date_for_new = $('#date').val()
            // Check to make sure it is not empty
            if (date_for_new != '') { 
                // Get the entered start time  
                start = $('#start').val()
                // Get the entered end time
                end = $('#end').val()
                // Get the chosen AM/PM for start
                start_diem = $('#start_diem').val()
                // Get the chosen AM/PM for end
                end_diem = $('#end_diem').val()
                // Make sure the start time is a valid time
                if (moment(date_for_new+" "+start+" "+start_diem).isValid()) {
                    // Make sure the end time is a valid time
                    if (moment(date_for_new+" "+end+" "+end_diem).isValid()) {
                        // Check to make sure the end time is later than the start time
                        if (moment(date_for_new+" "+start+" "+start_diem).unix() < moment(date_for_new+" "+end+" "+end_diem).unix()) {
                            // Get the length of the entry
                            time = moment.duration(moment(date_for_new+" "+end+" "+end_diem).diff(moment(date_for_new+" "+start+" "+start_diem))).format('HH:mm:ss')
                            // Get the chosen employee's entry
                            emp_id = $('#emp_id').val()
                            // Get the entered description
                            description = $('#description').val()
                            // Get the project id
                            project_id = $('#project_id').val()
                            // Get the project name
                            project_name = $('#project_id').find(':selected').attr('data-name')

                            $.post('add_new_entry_to_employee.php', {date:date_for_new,project_id:project_id,start:start,end:end,start_diem:start_diem,end_diem:end_diem,emp_id:emp_id,description:description}, function(result){
                                

                                // Create a new entry object
                                entry = {id:result,project_name:project_name,time:time,date:date_for_new,start:start,startdiem:start_diem,end:end,enddiem:end_diem,description:description}
                                // Put the object into the JSON
                                entries.push(entry)
                                // Check if they are filtering dates
                                if ( filter_date == false){
                                    // If not, display all entries
                                    display_all()
                                } else {
                                    // If so, display in that date range
                                    date_compare()
                                }
                            });
                            $("#add_entry_modal").css("display","none");
                        } else {
                            alert("Your start time is later than your end time.")
                        }
                    } else {
                        alert("Your end time is not a valid time")
                    }
                } else {
                    alert("Your start time is not a valid time.")
                }
            } else {
                alert("You must enter a date.");
            }

        });
        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
            // Stop displaying info_modal
            $(document.getElementById('info_modal')).css('display','none');
            // Stop displaying add_entry_modal  
            $(document.getElementById('add_entry_modal')).css('display','none');    
        });

        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_myModal")));
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_add_entry_modal")));
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("moveable_info_modal")));
        
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

    //add entry function on click
    $('#list').on('click', '.add_entry' , function(){
        // Display the add_entry_modal
        $("#add_entry_modal").css("display","block"); 
    });

    //info button function on click
    $('#list').on('click', '.info_button_managetime' , function(){
        time_id = $(this).val(); //get time id
        //load entry info
        $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
        //display info in modal
        $("#info_modal").css("display","block");
    });

    //edit function on click
    //load all data and display in modal
    $('#list').on('click', '.edit' , function(){
        $(document.getElementById('myModal')).css('display','block');
        $('#tid').val($(this).val());
        $('#date_edit').val($(this).attr("data-date"))
        $('#description_edit').val($(this).attr("data-description"))
        $('#start_edit').val($(this).attr("data-start"))
        $('#end_edit').val($(this).attr("data-end"))
        $('#start_diem_edit').val($(this).attr("data-startdiem"))
        $('#end_diem_edit').val($(this).attr("data-enddiem"))
    });





</script>
<!-- end javascript -->










<!-- Hidden modals -->

<!-- Modal that appears when you click one of the edit buttons -->
<div id="myModal" class="modal">

    <div style='display:block;' class='outside_of_modal'></div>

    <div class='centering-modal'>
        <!-- Modal content -->
        <div class='moveable_modal' style='height:280px;'id='moveable_myModal'>

            <div id='moveable_myModalheader' style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                <p id='myModal_text' style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Edit Entry</p>
            </div>
            
            <!-- edit_entry form -->
            <input form='edit_entry' name='time_id' id='tid' value='' type='hidden'>

            <!-- time id -->
            <input id='tid' value='' type='hidden'>
            <!-- Enter Date, Enter Start, Enter Finish -->
            <div style='height:50px;'>
                <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
                <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
                <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
            </div>

            <!-- start and end date -->
            <div style='height:20px;'>
                <!-- start date -->
                <input name='date' id='date_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
                <input name='start' value='10:00'id='start_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
                <!-- select AM or PM -->
                <select id='start_diem_edit' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
                <!-- end date -->
                <input name='end' value='2:00'id='end_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
                <!-- select AM or PM -->
                <select id='end_diem_edit'name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option selected>PM</option>
                </select>
                <!-- Options button -->
                <button style='float:right; margin-right:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Options
                </button>
            </div>

            <!-- description field -->
            <div style='height:50px; margin-left:20px;'>
                <p style='float:left;padding:0;margin-top:20px;'>Description</p>
            </div>

            <!-- text area for description field -->
            <div style='height:80px; margin-left:20px;'>
                <textarea form='new_entry' name='desciption' id='description_edit' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
            </div>
            
            
            <div style='height:50px; margin-left:20px;'>
                <!-- save button -->
                <button form='new_entry' type='sumbit' id='save_edit' name='project_submit' style='float:right; margin-right:20px;width: 100px;
                    margin-top:-15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Save</button>
                <!-- Cancel button -->
                <button id='cancel_edit' style='float:right; margin-right:20px;width: 100px;
                    margin-top:-15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Cancel</button>
            </div>
        </div>
    </div>
</div>





<!-- Modal that appears when you click one of the info buttons -->
<div id="info_modal" class="modal">

    <div style='display:block;' class='outside_of_modal'></div>
    
    <div class='centering-modal' style='margin-top:2%;'>
        <div class='moveable_modal' style='height:600px; 'id='moveable_info_modal'>   
            
            
            <!-- Header to the modal -->
            <div id='moveable_info_modalheader' style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                <p id='myModal_text' style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Entry Info</p>
            </div>
            
            <div style='height:20px; background-color:#f4f9ff;'></div>
            <div id='entry_info'></div>

            <div style='height:65px;  background-color:#f4f9ff;'>
                <!-- Export button -->
                <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
                    margin-top:15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;                  
                    cursor: pointer;'>Export
                </button>
            <!-- Exit button -->
                <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
                    margin-top:15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Exit
                </button>
            </div>               
        </div>
    </div>
</div>


<!-- Modal that appears when you click the + ADD ENTRY button -->
<div id="add_entry_modal" class="modal" style='display:none;'>  
    <div style='display:block;' class='outside_of_modal'></div>
        <div class='centering-modal'>

        <div class='moveable_modal' style='height:350px;'id='moveable_add_entry_modal'>

            <div id='moveable_add_entry_modalheader' style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                <p id='myModal_text' style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Add New Entry</p>
            </div>

            <!-- use php to echo the employee id -->    
            <input form='new_entry' name='emp_id' id='emp_id' value=<?php echo $emp_id; ?> type='hidden'>

            <div style='height:50px;'>
                <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
                <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
                <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
            </div>

            
            <div style='height:20px;'>
                <!-- start date -->
                <input name='date' id='date' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
                <input name='start' value='10:00'id='start' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
                <!-- select AM or PM -->
                <select id='start_diem' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
                <!-- end date -->
                <input name='end' value='2:00'id='end' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
                <!-- select AM or PM -->
                <select name='end_diem'form='new_entry' id='end_diem' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option selected>PM</option>
                </select>
                <!-- options button -->
                <button style='float:right; margin-right:20px;width: 100px;
                        margin-top:-15px;
                        height: 34px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        color: #fff;
                        font-size: 14px;
                        cursor: pointer;'>Options
                </button>
            </div>

            <!-- select properties -->
            <div style='height:50px; margin-left:20px;'>
                <p style='float:left;padding:0;margin-top:20px;'>Select Project</p>
            </div>

            <div style='height:20px; margin-left:20px;'>
                <select id='project_id' name='project_id' form='new_entry' style='float:left;padding: 0 0 0 4px; margin-top:-15px; height:34px; width: 148px;'>
                    <!-- start php code -->
                    <?php 
                        // Get the company name 
                        $org_id = $_SESSION['u_org_id'];
                        // Get all the managers from that company
                        $sql = "SELECT * FROM projects WHERE org_id = '$org_id' AND status = 'active';";
                        // Put the result into $result
                        $result = mysqli_query($conn, $sql);
                        // Put each employee into an option 
                        while ($row = $result->fetch_assoc()) {
                            // Get the employee's email
                            $project_name = $row['project_name'];
                            // Get the employee's id
                            $project_id = $row['project_id'];
                            // Put the employee in an option
                            echo "<option data-name='$project_name' value='$project_id'>$project_name</option>";
                        }

                    ?>
                    <!-- end php code -->
                </select>
            </div>

            <!-- Description -->
            <div style='height:50px; margin-left:20px;'>
                <p style='float:left;padding:0;margin-top:20px;'>Description</p>
            </div>

            <!-- text area for description field -->
            <div style='height:80px; margin-left:20px;'>
                <textarea form='new_entry' name='desciption' id='description' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
            </div>

            <div style='height:50px; margin-left:20px;'>
                <!-- save button -->
                <button form='new_entry' type='sumbit' id='save_new_entry' name='project_submit' style='float:right; margin-right:20px;width: 100px;
                    margin-top:-15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Save
                </button>
                
                <!-- cancel button -->
                <button id='cancel_add_entry' style='float:right; margin-right:20px;width: 100px;
                    margin-top:-15px;
                    height: 34px;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Cancel
                </button>
            </div>

            <!-- <form id='new_entry' method='POST' action='add_new_entry_to_employee.php'>
            </form>    -->
            
        </div>
    </div>
</div>
