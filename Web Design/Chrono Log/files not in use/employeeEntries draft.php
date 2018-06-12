
<?php
    // Put the header in the page
    include_once 'header.php';
?>

<!-- Add the style sheet style_now to the page -->
<link rel="stylesheet" type="text/css" href="style_now.css">

<!-- Main part of page -->
<section class="main-container">

    <?php
        // Put the navigation in the page
        include_once 'nav.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>
        
        <?php 
            
            // Checking to see if the page the user came from sent information about the employee they want to view
            if (isset($_POST['viewemployee'])) {
                echo "here";
                // put emp_id into session variable
                $_SESSION['current_emp_id'] = $_POST['emp_id'];
                // put emp_first into session variable
                $_SESSION['current_emp_first'] = $_POST['emp_first'];
                // put emp_last into session variable
                $_SESSION['current_emp_last'] = $_POST['emp_last'];
            }
            // put emp_id into $emp_id
            $emp_id = $_SESSION['current_emp_id'];
            //echo $emp_id;
        ?>


    
        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='float:left; font-size:20px; line-height:40px;'><?php echo $_SESSION['current_emp_first']. ' ' . $_SESSION['current_emp_last']; ?></h1>
            </div>
        </div>




        <!-- Top row or 1st row 60px: 2 buttons 1 hidden button 1 dropdown menu -->
        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>

                <!-- Creates the filter button -->
                <button id ='filter-button' name='commentSubmit' class='button-style-2'>
                    <a style ='color:#fff;' >Filter</a>
                </button>

                <!-- Creates the drop down to select filter type -->
                <select id='filter-type' class='dropdown-style-1' style='float:right;'>
                    <option>all</option>
                    <option>day</option>
                    <option>month</option>
                    <option>year</option>
                </select>

                <!-- Creates the button to go to the employee's calendar -->
                <button name='commentSubmit' style='float:left;' class='button-style-2'>
                    <a style ='color:#fff;' href='employeeshift.php'>Calendar</a>
                </button>

                <!-- The all button to see all employee's entries -->
                <button id='all_button' name='commentSubmit' class='button-style-3'>
                    All
                </button>
            </div>
        </div>   
        <!-- End 1st row -->




        <!-- 2nd row 120px: 2 buttons 1 dropdown menu -->
        <div class='box-create' style='width:100%; height:120px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>

                <!-- Creates the button to export page's data to a selected type -->
                <button id='export' type='submit' class='button-style-2' name='delete3' style='background-color: rgb(194, 194, 194);'>
                    Export
                </button>

                <!-- Creates dropdown menu to select export type -->
                <select id='export-type' class='dropdown-style-1' style='float:right;'>
                    <option>cvs</option>
                    <option>excel</option>
                    <option>pdf</option>
                </select>

                <!-- Creates the button to delete selected entries if pressed -->
                <button type='submit' class='button-style-2' form='delete_selected' name='delete2' style='float:left;background-color: rgb(194, 194, 194);'>
                    Delete Selected
                </button>
            </div>
        </div> 
        <!-- End 2nd row -->





        <!-- Creates the arrows and display for the date filter. This is hidden on start -->
        <div style ='display:none; height:54px; margin-top:-54px; background-color:rgb(247, 247, 247);width:100%;'id='filter-date-slide' class='search-results'>
            <div style='float:left; margin-top:-3px; margin-left:33%;'><button class='arrow-button' id='time-back' style=''><</button></div>
            <div style='float:right; margin-top:-3px; margin-right:33%;'><button class='arrow-button' id='time-forward' style=''>></button></div>
            <div style=''id='date-display'></div>
        </div>

        <div id='search-results' class='search-results'>
        
        </div>





        <!-- Begin List Div that lists all of the entries from the employee -->
        <div id='list'>

        <?php

            // Creates database connection
            include 'includes/dbh.inc.php';
            // Start total_seconds to 0
            $total_seconds = 0;
            // Get the current company name 
            $org_name = $_SESSION['u_org_name'];
            // Get all the sumbitted entries of the employee
            $sql = "SELECT * FROM timeGeneral WHERE submitted = 'yes' AND emp_id = '$emp_id';";
            // Put the result into $result
            $result = mysqli_query($conn, $sql);


            // ----- Create the entry lines -----
            while ($row = $result->fetch_assoc()) {
                      
                echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247);'>";
                echo "<div id='projectBox' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'>";

                echo "<div style='float:left;margin-left:12px;'>";

                echo " Project Name: ";
                $project_id = $row['project_id'];
                
                // If the project_id was 0 it wasn't assigned to a project
                if ($project_id == 0) {
                    echo "---- No Project ----";
                } else {
                    $sql = "SELECT * FROM projects WHERE user_id = '$project_id' AND org_name = '$org_name';";
                    $result2 = mysqli_query($conn, $sql);
                    while ($row2 = $result2->fetch_assoc()) {
                        $project_name = $row2['project_name'];
                    }
                    echo $project_name;
                }
                

                echo " | Date: ";
                $time_start = $row['time_start'];
                echo date("Y M d",$time_start);
                echo " | Time: ";         
                echo $row['time'];
                $time = $row['time'];
                // converts and adds the time into seconds
                $array = explode(':', trim($time, ':'));
                $total_seconds += intval($array[0]) * 3600;
                $total_seconds += intval($array[1]) * 60;
                $total_seconds += intval($array[2]);
                
                echo "</div>"; 

                $tid = $row['time_id'];

                ?>
                
                <!-- Creates the checkbox on a line -->
                <label style = 'margin-top:10px; float:right; margin-right:15px;' class="checkbox-container">
                    <input form='delete_selected' type="checkbox" name='num[]' value='<?php echo $row['time_id']; ?>'>
                    <span class="checkmark"></span>
                </label>
                
                <?php
                // Creates the info button on a line
                echo "<button type='submit' value='$tid' class='info_button_managetime' name='time_id' style=' width: 60px;
                    height: 30px;
                    position:relative;
                    float:right;
                    margin-right:20px;
                    margin-top:10px;
                    border: none;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;'>Info</button>";
                // Creates the edit button on a line
                echo "<button type='button' value='$tid' class='edit' name='time_id' style=' width: 60px;
                    height: 30px;
                    position: relative;
                    margin-right:20px;
                    margin-top:10px;
                    float:right;
                    border: none;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;'>Edit</button>";

                echo "</div>";
                echo "</div>";

                
            }
            // ------ End line entries ------
        ?>

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
                <p style='    color: #b2b2b2;
                    background-color: #cbcbcb;
                    letter-spacing: .1em;
                    font-weight: 900;
                    text-align: center;
                    text-shadow:
                    -1px -1px 1px #7f7f7f,
                    2px 2px 1px #e5e5e5;'>
                    <?php

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
        </div>
        <!-- End list Div -->


       
        <form method="POST" name='delete_selected' id='delete_selected'>
            </form>  
        <?php
                  
        echo "<form id='edit' method='POST' action='editTimeGeneral.php'></form>";
                   
       if (isset($_POST['delete2'])){
           $box = $_POST['num'];
           while (list ($key, $val) = @each ($box)){ 
               mysqli_query($conn, "DELETE FROM timeGeneral WHERE time_id = $val");
           }
           ?>
               <script type="text/javascript">
                    window.location.href=window.location.href;
               </script>

           <?php


       }
        
       ?>



</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>

    $(document).ready(function() {
                
        var clicked_project_id;
        var date = moment();
        var type

        // What happens if the filter button is clicked
        $( "#filter-button" ).click(function() {
            
            // Gets what filter type the user selected
            type = $('#filter-type').val()

            // If the type was all the page is refreshed
            if (type == 'all'){
                location.reload();

            // What happens if the type was year
            } else if (type == 'year') {
                $(document.getElementById('filter-date-slide')).css('display','block')
                $(document.getElementById('date-display')).text(date.format('YYYY'))
                $(document.getElementById('list')).css('display','none')
                date_format = date.format('YYYY');
            
            // What happens if the type was month
            } else if (type == 'month') {
                $(document.getElementById('filter-date-slide')).css('display','block')
                $(document.getElementById('date-display')).text(date.format('YYYY-MM'))
                $(document.getElementById('list')).css('display','none')
                date_format = date.format('YYYY-MM');
                
            // What happens if the type was day
            } else {
                $(document.getElementById('filter-date-slide')).css('display','block')
                $(document.getElementById('date-display')).text(date.format('YYYY-MM-DD'))
                $(document.getElementById('list')).css('display','none')
                date_format = date.format('YYYY-MM-DD');
            }
            // Load what is found for that date into the #search-results div
            $('#search-results').load('search_filter_entries.php', {date_format:date_format, type:type});
        
        })

        // What happens if the arrow forward on the time filter is clicked
        $( "#time-forward" ).click(function() {  
            if (type=='year') {
                date.add(1, 'years').calendar();
                $(document.getElementById('date-display')).text(date.format('YYYY'))
                date_format = date.format('YYYY');
                
            } else if (type=='month') {
                date.add(1, 'months').calendar();
                $(document.getElementById('date-display')).text(date.format('YYYY-MM'))
                date_format = date.format('YYYY-MM');
                
            } else if (type=='day') {
                date.add(1, 'days').calendar();
                $(document.getElementById('date-display')).text(date.format('YYYY-MM-DD'))
                date_format = date.format('YYYY-MM-DD');
                
            }
            // Load what is found for that date into the #search-results div
            $('#search-results').load('search_filter_entries.php', {date_format:date_format, type:type});
            
        })

        // What happens if the arrow backward on the time filter is clicked
        $( "#time-back" ).click(function() {
            if (type=='year') {
                date.subtract(1, 'years').calendar();
                $(document.getElementById('date-display')).text(date.format('YYYY'))
                date_format = date.format('YYYY');
            } else if (type=='month') {
                date.subtract(1, 'months').calendar();
                $(document.getElementById('date-display')).text(date.format('YYYY-MM'))
                date_format = date.format('YYYY-MM');
            } else if (type=='day') {
                date.subtract(1, 'days').calendar();
                $(document.getElementById('date-display')).text(date.format('YYYY-MM-DD'))
                date_format = date.format('YYYY-MM-DD');
            }
            // Load what is found for that date into the #search-results div
            $('#search-results').load('search_filter_entries.php', {date_format:date_format, type:type});
        })

            // What happens if you click the export button
            $("#export").click(function() {
            export_type = $('#export-type').val()
            filtered = false;
                if (export_type == 'cvs') {
                    if (filtered == false) {
                        window.location.href = "export_cvs_employee_entries.php";
                    } else {
                            //window.location.href = "export_cvs_project_search.php?search=" + input;
                    }
                }
            })

        // What happens one of the edit buttons is clicked on an edit button
        $(".edit").click(function() {
            $(document.getElementById('myModal')).css('display','block')
            $('#tid').val($(this).val()) 
        })
        // What happends if the cancel button is clicked on a project
        $( "#cancel_edit" ).click(function() {
            $(document.getElementById('myModal')).css('display','none');
        })
        // What happends if the cancel button is clicked on a project
        $( "#save_edit" ).click(function() {
            $(document.getElementById('myModal')).css('display','none');
            date = $('#date').val()
            hours = $('#hours').val()
            id = $('#tid').val()
            
            $.post( "save_edit_entry_employee.php", {hours:hours,date:date, id:id});  
            
            // var old = $("#hour-"+id).text();
            // var new_old = parseFloat(old);
            
            //var total_hours = parseFloat($('#total-hours').text());
            
            // new_total = total_hours + (hours-new_old);
            // $('#total-hours').html(new_total.toFixed(2));
            // $("#hour-"+id).html(hours);
        })
        $( ".info_button_managetime" ).click( function() {
    
            time_id = $(this).val();
            $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
            $("#info_modal").css("display","block");
            
        });
        // What happens if the exit_data button is clicked
        $( "#exit_data" ).click( function() {
            // Stop displaying the info_modal
            $("#info_modal").css("display","none");
            
        });
        // What happens when you clicke the add_entry button
        $( "#add_entry" ).click( function() {
            // Display the add_entry_modal modal
            $("#add_entry_modal").css("display","block");
        });
        // What happens when you click the cancel_add_entry button
        $( "#cancel_add_entry" ).click( function() {
            // Stop displaying the add_entry_modal
            $("#add_entry_modal").css("display","none");
        });


    });




</script>

</div>
<!-- End main part of page -->










<!-- Hidden modals -->

<!-- Modal that appears when you click one of the edit buttons -->
<div id="myModal" class="modal" style='display:none;'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:240px; background-color:#fff; margin-top:10%;'>
        
        <!-- <input name='emp_id' id='emp_id' value=<?php echo $emp_id; ?> type='hidden'> -->
        <div style='height:50px;'>
            <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
            <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
            <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
        </div>

        
        <div style='height:20px;'>
            <input name='date' id='date' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
            <input name='start' value='10:00'id='start' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option>PM</option>
            </select>
            <input name='end' value='2:00'id='finish' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
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
            <textarea form='new_entry' name='desciption' id='description' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
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
                cursor: pointer;'>Save
            </button>
        
            <button id='cancel_edit' style='float:right; margin-right:20px;width: 100px;
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
    </div>
</div>





<!-- Modal that appears when you click one of the info buttons -->
<!-- <div id="info_modal" class="modal" style='display:none;'>
    <div style='width:55%; margin: 0 auto; height:90%; background-color:#fff; margin-top:2%;'>       
        
        <div id='entry_info'>
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
                cursor: pointer;'>Export
            </button>
        
            <button id='exit_data' style='float:left; margin-left:20px;width: 100px;
                margin-top:-15px;
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
</div> -->






<!-- Modal that appears when you click the + ADD ENTRY button -->
<!-- <div id="add_entry_modal" class="modal" style='display:none;'>  
    <div style='width:55%; margin: 0 auto; height:310px; background-color:#fff; margin-top:10%;'>
            
        <input form='new_entry' name='emp_id' id='emp_id' value=<?php echo $emp_id; ?> type='hidden'>

        <div style='height:50px;'>
            <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
            <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
            <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
        </div>

        
        <div style='height:20px;'>
            <input name='date' id='date' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
            <input name='start' value='10:00'id='start' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option>PM</option>
            </select>
            <input name='end' value='2:00'id='finish' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
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
            <p style='float:left;padding:0;margin-top:20px;'>Select Project</p>
        </div>

        <div style='height:20px; margin-left:20px;'>
            <select name='project_id' form='new_entry' style='float:left;padding: 0 0 0 4px; margin-top:-15px; height:34px; width: 148px;'>
                <?php 
                    // Get the company name 
                    $org_name = $_SESSION['u_org_name'];
                    // Get all the managers from that company
                    $sql = "SELECT * FROM projects WHERE org_name = '$org_name';";
                    // Put the result into $result
                    $result = mysqli_query($conn, $sql);
                    // Put each employee into an option 
                    while ($row = $result->fetch_assoc()) {
                        // Get the employee's email
                        $project_name = $row['project_name'];
                        // Get the employee's id
                        $project_id = $row['user_id'];
                        // Put the employee in an option
                        echo "<option value='$project_id'>$project_name</option>";
                    }

                ?>
            </select>
        </div>

        <div style='height:50px; margin-left:20px;'>
            <p style='float:left;padding:0;margin-top:20px;'>Description</p>
        </div>

        <div style='height:80px; margin-left:20px;'>
            <textarea form='new_entry' name='desciption' id='description' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
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
                cursor: pointer;'>Save
            </button>
        
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

        <form id='new_entry' method='POST' action='add_new_entry_to_employee.php'>
        </form>   
        
    </div>
</div> -->

<?php
//echo $_SESSION['current_emp_id'];
?>



