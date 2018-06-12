<?php
    // Put header in the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['m_id'])) {
        // If not, exit the code
        exit;
    }
    // Create the connection to the database
    include 'includes/dbh.inc.php';

    // If some came here from the navigation, set the session to have the project id and name clicked
    if(isset($_GET['project_id'])){
        // put the project_id into $pid
        $pid = $_GET['project_id'];
        // Get the company id
        $org_id = $_SESSION['m_org_id'];
        // Check to make sure this project id is from there company
        $sql2 = "SELECT * FROM projects WHERE project_id = '$pid' AND org_id = '$org_id';";
        // Put result in to $result2
        $result = mysqli_query($conn, $sql2);
        // Get the number of results
        $resultCheck = mysqli_num_rows($result);
        // Check if there were any results
        if ($resultCheck == 0) {
            // Send them to the home page
            exit;
        }
        // Get the project id
        $_SESSION['project_id'] = $_GET['project_id'];
    }


    // Go through results
    while ($row = $result->fetch_assoc()) {
        // Get the project name
        $_SESSION['project_name'] = $row['project_name'];
        // put the project_name into $project_name
        $project_name = $row['project_name'];
    }
    // Get all the sumbitted entries of the employee
    $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id';";
    // Put the result into $result
    $result = mysqli_query($conn, $sql);
    // Go through the results 
    while ($row = $result->fetch_assoc()) {
        // Get if the employee should be allowed to edit time
        $manager_allow_edit = $row['allow_manager_time_edit'];
    }
    
?>

<!-- Hidden input to allow javescript to get the project id of the project being viewed -->
<input type='hidden' id="project_id" value=<?php echo $_SESSION['project_id']; ?>>
<!-- add the stylesheet style_now to the page -->
<link rel="stylesheet" type="text/css" href="style_now.css">










<!-- Main part of page -->
<section class="main-container" style=''>
    
    <?php
        // Put the navigation bar in for managers
        include 'nav_for_managers.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>          


        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h4><?php echo $_SESSION['project_name']; ?></h4>
            </div>
        </div>
        

        <!-- Top row 60px: 3 buttons and 2 dropdown menus -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>

                <!-- Creates the filter button -->
                <button id ='filter-button' name='commentSubmit' class='button-style-2'>
                    Filter
                </button>

                <!-- Creates the drop down to select filter type -->
                <select id='filter-type' style='width: 150px;
                    margin-top:20px;
                    margin-right:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;'>
                    <option>all</option>
                    <option>day</option>
                    <option>week</option>
                    <option>month</option>
                    <option>year</option>
                    <option>pay period</option>
                </select>

                <!-- Button to view the data modal -->
                <button id='data_button' type='submit' name='commentSubmit' class='button-style-1' style=' width: 150px;background-color: rgb(200, 200, 200);'>
                    Data
                </button>
 
            </div>
        </div>
        <!-- End top or 1st row -->
        



        <!-- 2nd row 50px : 3 buttons 2 dropdown menus -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Button to make an export of the project -->
                <button  type='submit' name='delete3' id='export' class='button-style-2' style='background-color: rgb(194, 194, 194);'>
                    Export
                </button>

                <!-- Drop down menu to choose export type -->
                <select id='export-type' style='width: 150px;
                    margin-top:20px;
                    margin-right:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;'>
                    <option value='cvs'>csv</option>
                    <!-- <option value='excel'>excel</option>
                    <option value='pdf'>pdf</option> -->
                </select>

                <!-- Button to delete entry -->        
                <input type ='submit' id='delete_selected' value='Delete Selected'name='delete2' class='button-style-1' style='background-color: rgb(200, 200, 200); width:150px;'>

            </div>
        </div>
        <!-- End of 2nd row -->

                <!-- 3rd row: 1 button -->
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




        <!-- Begin List Div. Displays every entry of the entries for the project -->
        <div id='list'>
    
                

        </div>
        <!-- End list div -->


        <?php
            if ($manager_allow_edit == 'yes') {
                //Area for the button to add more entries to project
                echo "
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
                </div>";
            }
        ?>

        <!-- shows the total time of the entries -->
        <div class='timeStyle' style='font-size:24px;padding: 2px; margin:0 auto; background-color:#cbcbcb;width:200px; border:2px;border-radius:4px;border-style: outset; height:30px; margin-top:10px; line-height:30px;'>
            <p id='total_time' style='    color: #b2b2b2;
                background-color: #cbcbcb;
                letter-spacing: .1em;
                font-weight: 900;
                text-align: center;
                text-shadow:
                -1px -1px 1px #7f7f7f,
                2px 2px 1px #e5e5e5;'>00:00:00
            </p>
        </div>
            
    </div>
</section>
<!-- End main part of page -->





















<!-- Add a moment format -->
<script src="duration_format.js"></script>
<!-- Add moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Add jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>

    // When page is ready do this
    $(document).ready(function() {
        
                
        // Initialize click_project_id
        var clicked_project_id;
        // Create moment object for earliest entry to be shown
        var date = moment();
        // Create moment object for latest entry to be shown
        var date_end = moment();
        // Set type to none
        var type = 'none';
        // Initialize date_format
        var date_format;
        // Initialize project_load
        var project_load;
        // Default filter_date to false
        var filter_date = false;
        var time
        var date_for_new
        var date_for_edit
        



        // Get all of the entries from the project
        $.post('load_project_entries_to_objects_managers.php', {project_load:project_load}, function(result) {
            
            // Turn the result into JSON objects
            entries = JSON.parse(result)
            // Display all of these entries at the start of page
            display_all()
            
        })

        // Create the entry lines with html
        function prepare_entry_line(first,last,date,time,id,start,startdiem,end,enddiem,description) {
            // Create the text for the entry
            text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> First Name: " + first + " | Last Name: " + last + " | Date: " + date + " | Time: " + time + "</div><label style = 'margin-top:10px; float:right; margin-right:15px;' class='checkbox-container'><input class='entry_check' type='checkbox' name='num[]' value='" + id + "'><span class='checkmark'></span></label><button type='submit' value='" + id + "' class='info_button_managetime entry-button-style-1' name='time_id'>Info</button><button type='button' data-start='" + start +"' data-startdiem ='" + startdiem + "' data-end='" + end +"' data-enddiem='" + enddiem + "' data-date='" + date + "' data-description='" + description + "' value='" + id + "' class='edit entry-button-style-1 time_id' name='time_id' style=' width: 60px;'>Edit</button></div></div>";
            // Return the text
            return text
        }
        
        
        // What happens if the sorting menu is changed
        $('#sorting').change(function() {
            
            if ($('#sorting').val() == 'alphabetical'){
                
                entries = merge_alphabetical(entries)
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
        function display_all() {
            // Clear all entries
            $('#list').html('')
            // Create moment duration to add up total time
            total_time = moment.duration()
            // Go through every entry
            for (i = 0; i < entries.length; i++) {
                // Get the html for the entry
                text = prepare_entry_line(entries[i].first, entries[i].last,entries[i].date ,entries[i].time, entries[i].id, entries[i].start,entries[i].startdiem,entries[i].end,entries[i].enddiem ,entries[i].description)
                // Put the entry on #list
                var entry = $('#list').append(text)
                // Create time entry object
                entry_time = moment.duration(entries[i].time)  
                // Add to the total time
                total_time.add(entry_time) 
            }
            //alert(total_time)
            // Put the total time at the bottum
            //alert(total_time.format('HH:mm:ss'))
            //$('#total_time').html(total_time.format('HH:mm:ss'))
            
        }
       
        
        // // Merge function to sort entry objects into alphabetical order with the last name
        function merge_alphabetical(data) {
            
            var length = data.length;
                
                
                if (length === 1) {
                    return [data[0]];
                }
                
                if (length === 2) {
                    if (data[0].last.toLowerCase() > data[1].last.toLowerCase()) {
                        return [data[1], data[0]];
                    }
                                
                    return [data[0], data[1]];
                }
                    
                var first  = merge_alphabetical(data.slice(0, Math.ceil(length / 2)));
                var second = merge_alphabetical(data.slice(first.length));
                
                var result = [];
                
                while (first.length && second.length) {
                    if (first[0].last.toLowerCase() > second[0].last.toLowerCase()) {
                        result.push(second.shift());
                    } else {
                        result.push(first.shift());
                    }
                }
                
            return result.concat(first, second);
        }

        // // Merge function to sort the entry objects into order by date
        function merge_date(data) {
    
            var length = data.length;
                
                
                if (length === 1) {
                   
                    return [data[0]];
                }
                
                if (length === 2) {
                    if (moment(data[0].date).unix() > moment(data[1].date).unix()) {
                        return [data[1], data[0]];
                    }
                    
                    return [data[0], data[1]];
                }
                    
                var first  = merge_date(data.slice(0, Math.ceil(length / 2)));
                var second = merge_date(data.slice(first.length));
                
                var result = [];
                
                while (first.length && second.length) {
                    if (moment(first[0].date).unix() > moment(second[0].date).unix()) {
                        
                        result.push(second.shift());
                    } else {
                        
                        result.push(first.shift());
                    }
                }
                
            return result.concat(first, second);
        }

        // Merge function to sort entry objects into order by their length of time
        function merge_length(data) {
            
            
            var length = data.length;
            
                if (length === 1) {
                    return [data[0]];
                }
                
                if (length === 2) {
                    if (moment.duration(data[0].time) > moment.duration(data[1].time)) {
                        return [data[1], data[0]];
                    }
                                
                    return [data[0], data[1]];
                }
                    
                var first  = merge_length(data.slice(0, Math.ceil(length / 2)));
                var second = merge_length(data.slice(first.length));
                
                var result = [];
                
                while (first.length && second.length) {
                    if (moment.duration(first[0].time) > moment.duration(second[0].time)) {
                        result.push(second.shift());
                    } else {
                        result.push(first.shift());
                    }
                }
                
            return result.concat(first, second);
        }

        

        // $('#date').val(moment().format('YYYY-MM-DD'))

        // found = $('#found_entries').val()

        // if (found == 'not_found'){
        //     $("#export").attr("disabled","disabled");
        // }

        // Creates entries based on if they fall inbetween two dates. date and date_end are the moment objects
        function date_compare() {
            // Clear out the entries
            $('#list').html('')
            // Create moment duration to add up total time
            total_time = moment.duration()
                
            for (i = 0; i < entries.length; i++) {
                if (moment(entries[i].date).unix() >= date.unix() && moment(entries[i].date).unix() < date_end.unix()) {
                    // Get the html for the entry
                    text = prepare_entry_line(entries[i].first, entries[i].last,entries[i].date ,entries[i].time, entries[i].id, entries[i].start,entries[i].startdiem,entries[i].end,entries[i].enddiem ,entries[i].description)
                    // Put the entry on #list
                    var entry = $('#list').append(text)
                    // Create time entry object
                    entry_time = moment.duration(entries[i].time)  
                    // Add to the total time
                    total_time.add(entry_time) 
                    
                }
            }
           
            // Put the total time at the bottum
            //$('#total_time').html(total_time.format('HH:mm:ss'))
            
        }

        // What happens if the filter button is clicked
        $( "#filter-button" ).click(function() {
            
            filter_date = true;
            
            // Gets what filter type the user selected
            type = $('#filter-type').val()
            
            // If the type was all the page is refreshed
            if (type == 'all'){
                location.reload();

            // What happens if the type was year
            } else if (type == 'year') {
                $(document.getElementById('start-display')).val(date.startOf('year').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('year').format('YYYY-MM-DD'))
                date_compare()
            
            
            // What happens if the type was month
            } else if (type == 'month') {
                
                $(document.getElementById('start-display')).val(date.startOf('month').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('month').format('YYYY-MM-DD'))
                date_compare()
                
                
                

            } else if (type == 'week') {
                $(document.getElementById('start-display')).val(date.startOf('week').format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.endOf('week').format('YYYY-MM-DD'))
                date_compare()
                
            
            // What happens if the type was day
            } else {
                $(document.getElementById('start-display')).val(date.format('YYYY-MM-DD'))
                date_end = date.clone()
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
                date_compare()
            }
            
            // Load what is found for that date into the #search-results div
            $(document.getElementById('filter-date-slide')).css('display','block')
            //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type} );
            //add_click_handlers();
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
            // Load what is found for that date into the #search-results div
            //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type});
            //add_click_handlers();
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
            // Load what is found for that date into the #search-results div
            //$('#list').load('search_filter_entries_projects.php', {date_format:date_format, type:type} );
            //add_click_handlers();
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
            } else {
                alert("Your start date is later than your end date.")
                $(document.getElementById('end-display')).val(date_end.format('YYYY-MM-DD'))
            }
        })


        // What happends if the cancel button is clicked on a project
        $( "#cancel_edit" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
        })

        // What happens when you click the cancel_add_entry button
        $( "#delete_selected" ).click( function() {
            // Get an array of with the ids of all the checkboxs selected
            var arr = $.map($('.entry_check[type="checkbox"]:checked'),function(checkbox){
                // Get the checkbox value. This is the entry id
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

        // What happends if the save button under the edit modal is clicked
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
                            time_id = $('#tid').val()
                            // Get the employee's id
                            emp_id = $('#emp_id').val()
                            // Get the entered description
                            description = $('#description_edit').val()
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
                                        break;
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

        // What happens if the export button is clicked
        $("#delete_project_button").click(function() {
            
            var check = confirm("Are you sure you want to DELETE this project? (Can be recovered)")
            project_delete = 'yes';
            if (check == true){
                $.post('delete_project.php',{project_delete:project_delete}, function(){
                    window.location.replace('http://localhost/phplessons/view_projects.php')
                })
                
            }
            

        })

        // What happens if the export button is clicked
        $("#export").click(function() {
            
            export_type = $('#export-type').val()
            if (export_type == 'cvs') {     
                window.location.href = "export_cvs_project_entries.php";

            }
        })

        // What happens if the data button is clicked
        $("#data_button").click(function() {
            $(document.getElementById('data_modal')).css('display','block');
        });
        // What happens if the exit button is clicked
        $( "#exit_data_modal" ).click(function() {
            $(document.getElementById('data_modal')).css('display','none');            
        });
        $( ".info_button_managetime" ).click( function() {
            time_id = $(this).val();
            $("#entry_info").load("load_entry_info.php", { time_id:time_id });
            $("#info_modal").css("display","block");
        });
        // What happens if the add_manager button is clicked
        $( "#add_manager" ).click( function() {
            
            manager_id = $('#manager_id').val()
            manager_added = 'set';
            $.post('add_manager.php', {manager_id:manager_id,manager_added:manager_added}, function(){
                $("#manager_load").load("manager_load.php");
            });

        });
        // What happens if the add_manager button is clicked
        $( "#add_employee" ).click( function() {
            
            employee_id = $('#employee_id').val()
            employee_added = 'set';
            $.post('add_employee.php', {employee_id:employee_id,employee_added:employee_added}, function(){
                $("#employee_load").load("employee_load.php");
            });

        });
        // What happens if the exit_info button is clicked
        $( "#exit_data" ).click( function() {
            // stop displaying the info_modal modal
            $("#info_modal").css("display","none");
        });
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
        $( "#add_manager_small_button" ).click( function() {
            // Display the small_modal_manager modal
            $("#small_modal_manager").css("display","block");
        });
        // What happens if the exit_small_modal_manager button is clicked
        $( "#exit_small_modal_manager" ).click( function() {
            // stop displaying the small_modal_manager modal
            $("#small_modal_manager").css("display","none");     
        });
        // What happens if the add_entry button is clicked
        $( "#add_entry" ).click( function() {
            // Display the add_entry_modal
            $("#add_entry_modal").css("display","block"); 
            // Set the date picker to today 
            $("#date").val(moment().format('YYYY-MM-DD'))
        });
        
        // What happens if the cancel_add_entry button is clicked
        $( "#cancel_add_entry" ).click( function() {
            // stop displaying the add_entry_modal modal
            $("#add_entry_modal").css("display","none"); 
        });
        // What happens if the cancel_add_entry button is clicked
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
                            // Get the employee's first name
                            first = $('#emp_id').find(':selected').attr('data-first')
                            // Get the employee's last name
                            last = $('#emp_id').find(':selected').attr('data-last')
                            // Add the entry to the database
                            $.post('add_new_entry_to_project.php', {date:date_for_new,start:start,end:end,start_diem:start_diem,end_diem:end_diem,emp_id:emp_id,description:description}, function(result){
                                // Create a new entry object
                                entry = {id:result,first:first,last:last,time:time,date:date_for_new,start:start,startdiem:start_diem,end:end,enddiem:end_diem,description:description}
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

    });

    $('#list').on('click', '.time_id' , function(){
        $(document.getElementById('myModal')).css('display','block');
        $('#tid').val($(this).val());
        $('#date_edit').val($(this).attr("data-date"))
        $('#description_edit').val($(this).attr("data-description"))
        $('#start_edit').val($(this).attr("data-start"))
        $('#end_edit').val($(this).attr("data-end"))
        $('#start_diem_edit').val($(this).attr("data-startdiem"))
        $('#end_diem_edit').val($(this).attr("data-enddiem"))
    });
    $('#list').on('click', '.info_button_managetime' , function(){
        time_id = $(this).val();
        $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
        $("#info_modal").css("display","block");
    });
    $('#list').on('click', '.add_entry' , function(){
        // Display the add_entry_modal
        $("#add_entry_modal").css("display","block"); 
    });
    // function add_click_handlers() {
        
    //     $( "#test_btn" ).click( function() {
              
    //         $(document.getElementById('myModal')).css('display','block');
    //         $('#tid').val($(this).val())
            
    //     });
    //     $( ".info_button_managetime" ).click( function() {
    //         time_id = $(this).val();
    //         $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
    //         $("#info_modal").css("display","block");
            
    //     });
        
    // }



</script>






<!-- Hidden modals -->
<div id="data_modal" class="modal">
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:90%; background-color:#fff; margin-top:2%;'>
            
        <div style='height:20px; margin-top:20px;'>
            
        </div>

        <div style='height:20px;'>
            <p style='float:left;margin-left:20px;padding:0;'>Total Entries</p>
            <p style='float:left'><?php echo ": "; echo $resultCheck; ?></p>
            <p style='float:left;margin-left:50px;padding:0;'>Total Time Entered</p>
            <p style='float:left'> <?php echo ": "; echo $totalHours; ?></p>
            <p id ='total-hours-data' style='float:left'></p>
        </div>

        <div style='height:20px;'>
            <p style='text-decoration: underline;float:left;margin-left:20px;padding:0;'>Employees Assigned To Project</p>
            <p style='text-decoration: underline;float:left;margin-left:120px;padding:0;'>Managers Assigned To Project</p>
        </div>
        <div style='height:500px; margin-left:20px;'>
        
        <div style='float:left; width:230px;'>
        
        <?php 
        

            $sql = "SELECT * FROM employees WHERE emp_org = '$org_id';";
            $result = mysqli_query($conn, $sql);
                            

            // Put each employee into an option 
            while ($row = $result->fetch_assoc()) {
                
                $email = $row['emp_email'];
                $emp_id = $row['emp_id'];
                $sql2 = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id' AND project_id = '$pid';";
                $result2 = mysqli_query($conn, $sql2);
                $resultCheck = mysqli_num_rows($result2);
                if ($resultCheck > 0){
                    echo "
                    <div style='height:27px;'>
                    <div style='width: 100%; height:25px;
                    
                    background-color: rgb(144, 223, 255);
                    border-radius: 4px;font-size:16px;'><p style='margin-left:30px; line-height:25px;'>$email
                    </p></div></div>";
                }
            
            }




        ?>

        <div style='height:27px;'>
            <button id='add_employee_small_button' style='width: 100%; height:25px;
                background-color: rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;'><p style='cursor:pointer;'>+ Add Employee
                </p>
            </button>
        </div>



        </div>        
        <div style='float:left; margin-left: 70px; width:230px;'>
        <?php 
        
        $sql = "SELECT * FROM managers WHERE manager_org_name = '$org_name';";
        $result = mysqli_query($conn, $sql);
                        

        // Put each employee into an option 
        while ($row = $result->fetch_assoc()) {
            
            $email = $row['manager_email'];
            $manager_id = $row['manager_id'];
            $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);
            if ($resultCheck > 0){
                echo "
                <div style='height:27px;'>
                <div style='width: 100%; height:25px;
                
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'><p style='margin-left:30px; line-height:25px;'>$email
                </p></div></div>";
            }
        }



        ?>

        <div style='height:27px;'>
            <button id='add_manager_small_button' style='width: 100%; height:25px;
                background-color:  rgb(218, 218, 218);
                border-radius: 4px;font-size:16px;'><p style='cursor:pointer;'>+ Add Manager
                </p>
            </button>
        </div>

        </div>


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
        
            <button id='exit_data_modal' style='float:left; margin-left:20px;width: 100px;
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






<div id="small_Modal" class="modal" style='display:none; z-index:6'>
    <div id='add_emp_id_small' style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:93px; width:150px;'>
    <select  name='employee_id' style='width: 150px;
        height: 40px;
        float:left;
        margin:0 auto;
        border: none;
        background-color:white;
        font-family: arial;
        font-size: 16px;'>
        <?php 
            // Get all assignmenst to that manager
            $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
            // Put the result into $result
            $result3 = mysqli_query($conn, $sql);
            
            while ($row3 = $result3->fetch_assoc()) {

                if ($row3['emp_id'] != null) {
                    // Get the project id
                    $emp_id = $row3['emp_id'];
                   
                    // Get all of the assignments for that manager
                    $sql = "SELECT * FROM employees WHERE emp_id = '$emp_id' AND emp_org = '$org_id'";
                    // Put the result into $result
                    $result = mysqli_query($conn, $sql);
                    while ($row2 = $result->fetch_assoc()) {
                        
                        $emp_email =  $row2['emp_email'];
                        
                        if (strlen($emp_email) > 28) {
                            $emp_email = substr($emp_email, 0, 26)." ...";
                        }

                        echo "<option value='$emp_id'>$email $added</option>";
                        
                    }
                }
            }

        ?>
    </select>
    <button type='sumbit' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Add</button>
    <button type='sumbit' id='exit_small_modal' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Cancel</button>

    </div>

    </div>


<div id="small_modal_manager" class="modal" style='display:none; z-index:6'>
    <div style='margin:0 auto; margin-top:20%; background-color: rgb(218, 218, 218); height:93px; width:150px;'>
    <select name='manager_id' style='width: 150px;
    height: 40px;
    float:left;
    border: none;
    background-color: white;
    font-family: arial;
    font-size: 16px;'>
    <?php 
        // Get the company name 
        $org_name = $_SESSION['u_org_name'];
        // Get all the managers from that company
        $sql = "SELECT * FROM managers WHERE manager_org_name = '$org_name';";
        $result = mysqli_query($conn, $sql);
        

        // Put each manager into an option 
        while ($row = $result->fetch_assoc()) {
            
            $added = "";
            $email = $row['manager_email'];
            $manager_id = $row['manager_id'];
            $sql2 = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id' AND project_id = '$pid';";
            $result2 = mysqli_query($conn, $sql2);
            $resultCheck = mysqli_num_rows($result2);
            if ($resultCheck > 0){
                $added = " (Already added to project)";
            }
            echo "<option value='$manager_id'>$email $added</option>";
        }
        //echo "<input type='hidden' name='added' value='$add'>";

    ?>
</select>
    <button type='sumbit' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Add</button>
    <button type='sumbit' id='exit_small_modal_manager' name='project_submit' style=';width: 150px;
        margin-top:1px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        cursor: pointer;'>Cancel</button>

    </div>

    </div>



    <!-- Modal that comes up when edit button is clicked -->
    <div id="myModal" class="modal" style='display:none;'>
        <!-- Modal content -->
        <div style='width:55%; margin: 0 auto; height:240px; background-color:#fff; margin-top:10%;'>
            

        <input id='tid' value='' type='hidden'>
        <div style='height:50px;'>
            <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
            <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
            <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
        </div>

        
        <div style='height:20px;'>
            <input name='date' id='date_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
            <input name='start' value='10:00'id='start_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select id='start_diem_edit' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option>PM</option>
            </select>
            <input name='end' value='2:00'id='end_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select id='end_diem_edit'name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option selected>PM</option>
            </select>
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

        <div style='height:50px; margin-left:20px;'>
            <p style='float:left;padding:0;margin-top:20px;'>Description</p>
        </div>

        <div style='height:80px; margin-left:20px;'>
            <textarea form='new_entry' name='desciption' id='description_edit' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
        </div>
        
        <div style='height:50px; margin-left:20px;'>
            <button form='new_entry' type='sumbit' id='save_edit' name='project_submit' style='float:right; margin-right:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Save</button>
        
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

        <!-- <form id='new_entry' method='POST' action='add_new_entry_to_project.php'>
        </form> -->

            
            
            
        </div>
    </div>







<!-- Modal to enter more entries -->
<div id="add_entry_modal" class="modal" style='display:none;'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:310px; background-color:#fff; margin-top:10%;'>
        

        <input id='tid' value='' type='hidden'>
        <div style='height:50px;'>
            <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
            <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
            <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
        </div>

        
        <div style='height:20px;'>
            <input name='date' id='date' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
            <input name='start' value='10:00'id='start' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select id='start_diem' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option>PM</option>
            </select>
            <input name='end' value='2:00' id='end' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select id='end_diem' name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option selected>PM</option>
            </select>
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



        <div style='height:50px; margin-left:20px;'>
            <p style='float:left;padding:0;margin-top:20px;'>Select Employee</p>
            <!-- <p style='float:left;padding:0;margin-top:20px;margin-left:74px;'>Enter First</p>
            <p style='float:left;padding:0;margin-top:20px;margin-left:74px;'>Enter Last</p> -->
        </div>

        <div style='height:20px; margin-left:20px;'>
            <select id='emp_id' name='emp_id' form='new_entry' style='float:left;padding: 0 0 0 4px; margin-top:-15px; height:34px; width: 148px;'>
                <?php 
                // Get all assignmenst to that manager
                $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
                // Put the result into $result
                $result3 = mysqli_query($conn, $sql);
                
                while ($row4 = $result3->fetch_assoc()) {

                    if ($row4['emp_id'] != null) {
                        // Get the project id
                        $emp_id = $row4['emp_id'];
                        // Get all of the assignments for that manager
                        $sql = "SELECT * FROM employees WHERE emp_id = '$emp_id' AND emp_org = '$org_id'";
                        // Put the result into $result
                        $result = mysqli_query($conn, $sql);
                        while ($row5 = $result->fetch_assoc()) {
                            
                            $emp_email = $row5['emp_email'];
                            
                            if (strlen($emp_email) > 28) {
                                $emp_email = substr($emp_email, 0, 26)." ...";
                            }

                            echo "<option value='$emp_id'>$emp_email</option>";
                            
                        }
                    }
                }

                ?>
            </select>
            <!-- <input name='date' id='date' form='save_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 105px;' type=text>
            <input name='start' id='start' form='save_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 105px;' type=text> -->
        </div>
        <div style='height:50px; margin-left:20px;'>
            <p style='float:left;padding:0;margin-top:20px;'>Description</p>
            
        </div>
        <div style='height:80px; margin-left:20px;'>
            <textarea form='new_entry' name='desciption' id='description' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
        </div>
        <div style='height:50px; margin-left:20px;'>
            <button form='new_entry' type='sumbit' id='save_new_entry' name='project_submit' style='float:right; margin-right:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Save</button>
        
            <button id='cancel_add_entry' style='float:right; margin-right:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Cancel</button>
        </div>

        <!-- <form id='new_entry' method='POST' action='add_new_entry_to_project.php'>
        </form> -->
        
        
    </div>
</div>


<div id="info_modal" class="modal" style='display:none;'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:90%; background-color:#fff; margin-top:2%;'>
            
    <div style='height:20px; background-color:#f4f9ff;'></div>
    <div id='entry_info'>
    </div>

    <div style='height:65px;  background-color:#f4f9ff;'>
    <button type='sumbit' name='project_submit' style='float:left; margin-left:20px;width: 100px;
        margin-top:15px;
        height: 34px;
        border: none;
        background-color: rgb(66, 85, 252);
        font-family: arial;
        color: #fff;
        font-size: 14px;
        
        cursor: pointer;'>Export</button>

    <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
        margin-top:15px;
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




