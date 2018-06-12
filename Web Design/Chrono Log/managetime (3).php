<?php
    include_once 'header.php';
    include 'includes/dbh.inc.php';
?>

<link rel="stylesheet" type="text/css" href="style_now.css">






<!-- Main part of page -->
<section class="main-container">
    <div class="centered-wrapper">

        <!-- Creates the top header that says Manage Time -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='float:left; font-size:20px; line-height:40px;'>Manage Time</h1>
            </div>
        </div>
    
        <!-- 1st row or top row : 1 button 1 dropdown menu -->
        <div class='box-create' style='width:100%; height:120px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
            


                <form method='GET' action='managetime.php'>
                    <button  
                        style=' width: 150px;
                        margin-top:20px;
                        height: 40px;
                        float:left;
                        margin-right:20px;
                        border: none;
                        background-color: rgb(66, 85, 252);
                        font-family: arial;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;'>
                        Filter
                    </button>

                    <select name='project_filter' id='project-select' class='dropdown-style-1' style='width: 150px;
                        margin-top:20px;
                        height: 40px;
                        float:left;
                        border: none;
                        background-color: rgb(200, 200, 200);
                        font-family: arial;
                        font-size: 16px;'>
                            <option value='0'>No Project</option>
                            <?php
                                // Get the employee's id
                                $emp_id = $_SESSION['e_id'];
                                // Get all the projects the employee is assigned to
                                $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id';";
                                // Put the result in result
                                $result2 = mysqli_query($conn, $sql); 
                                // Go through each result
                                while ($row = $result2->fetch_assoc()) {
                                    // Get the project id
                                    $project_id = $row['project_id'];
                                    // Find the project with that id
                                    $sql = "SELECT project_name FROM projects WHERE project_id = '$project_id';";
                                    // Put the result into $result3
                                    $result3 = mysqli_query($conn, $sql);
                                    // Go through the result
                                    while ($row2 = $result3->fetch_assoc()) {
                                        // Get the project name
                                        $project_name = $row2['project_name'];
                                    }
                                    // Put the project into an option
                                    echo "<option value='$project_id'>$project_name</option>";
                                }
                            ?>
                    </select>
                </form>

                <?php
                    if (isset($_GET['project_filter'])){


                        echo"<a href='managetime.php'
                        style=' width: 60px; line-height:40px;
                        margin-top:20px;
                        height: 40px;
                        float:left;
                        margin-right:20px;
                        border: none;
                        background-color: rgb(218, 218, 218);
                        font-family: arial;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;'>
                        All
                        </a>";
                    }


                ?>
            </div>
        </div>
        
        
        
        
        
        
        
        <?php

        $emp_id = $_SESSION['e_id'];

        if (isset($_GET['project_filter'])) {
            
            $project_id = $_GET['project_filter'];
            $sql = "SELECT * FROM timeGeneral WHERE submitted ='yes' AND project_id = '$project_id';";
        } else {
            $sql = "SELECT * FROM timeGeneral WHERE submitted ='yes';";
        }

        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {
            if ($row['emp_id']===$emp_id){
                
                echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
                echo "<div id='projectBox' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'>
                <p>";
                
                
                echo "<div style='float:left;margin-left:12px;'>";
                echo "Date: ";
                $time_start = $row['time_start'];
                echo date("Y M d",$time_start);
                echo " | Time: ";
                echo  $row['time'];

                $pid = $row['project_id'];
                if ($pid == 0) {
                    $project_name = '---- No Project ----';
                } else {
                    $sql = "SELECT project_name FROM projects WHERE project_id = '$pid';";
                    $result2 = mysqli_query($conn, $sql);
                    while ($row2 = $result2->fetch_assoc()) {
                        $project_name = $row2['project_name'];
                    }
                }

                echo " | Project name: ";
                if (strlen($project_name) > 30) {
                    $project_name = substr($project_name, 0, 27)." ...";
                }
                echo $project_name;
                echo "</div>";

                $description = $row['des'];
                $start_time = $row['time_start'];
                $start = date("g:i",$start_time);
                $start_diem = date("A",$start_time);

                $end_time = $row['time_end'];
                $end = date("g:i",$end_time);
                $end_diem = date("A",$end_time);
                $datastring_date = $row['date'];

                $tid = $row['time_id'];
                
                
                echo "<button value='$tid' data-start='$start' data-startdiem ='$start_diem' data-end='$end' data-enddiem='$end_diem' data-date='$datastring_date' data-description='$description' class='edit_entry' name='time_id' style=' width: 100px;
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
                cursor: pointer;'>Edit</button>";
                
                // Creates the info button to get the information on an entry
                echo "<button type='submit' value='$tid' class='info_button_managetime' name='time_id' style=' width: 100px;
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
                

                
                echo "</p></div>";
                echo "</div>";
                /*
                $totalHours = $totalHours + $hours;
                $totalMinutes = $totalMinutes + $minutes;
                $totalSeconds = $totalSeconds + $seconds;
                */
            }
        }
                  
        echo "<form id='edit' method='POST' action='submitProjectHours.php'></form>";
                   
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

    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>

    // When the page is ready this is run
    $(document).ready(function readyDoc() {

        // what happens if the info button on an entry is clicked
        $( ".info_button_managetime" ).click( function() {
            // Get the entrie's id
            time_id = $(this).val();
            // Load the entrie's info into the #entry_info on the info_modal
            $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
            // Display the info modal
            $("#info_modal").css("display","block");
        });

        // What happens if you click the x on the info modal
        $( "#exit_data" ).click( function() {
            // Stop displaying the info modal
            $("#info_modal").css("display","none");  
        });

        // What happens if you click the edit button on an entry
        $( ".edit_entry" ).click( function() {
            // Display the edit_entry_modal
            $("#edit_entry_modal").css("display","block");
            $('#date_edit').val($(this).attr("data-date"))
            $('#description_edit').val($(this).attr("data-description"))
            $('#start_edit').val($(this).attr("data-start"))
            $('#end_edit').val($(this).attr("data-end"))
            $('#start_diem_edit').val($(this).attr("data-startdiem"))
            $('#end_diem_edit').val($(this).attr("data-enddiem")) 
        });

        // What happens if you click the cancel button on the edit entry modal
        $( "#cancel_edit_entry" ).click( function() {
            // Stop displaying the edit_entry_modal
            $("#edit_entry_modal").css("display","none"); 
        });

    });
  
</script>

<!-- Hidden modals -->
<div id="info_modal" class="modal" style='display:none;'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:630px; background-color:#fff; margin-top:2%;'>
    
    
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




<!-- Modal to edit entries -->
<div id="edit_entry_modal" class="modal" style='display:none;'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:310px; background-color:#fff; margin-top:10%;'>
        

        <input id='tid' value='' type='hidden'>
        <div style='height:50px;'>
            <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
            <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
            <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
        </div>

        
        <div style='height:20px;'>
            <input name='date' id='date_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
            <input name='start' id='start_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select id='start_diem' name='start_diem_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                <option>AM</option>
                <option>PM</option>
            </select>
            <input name='end' id='end_edit' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
            <select id='end_diem_edit' name='end_diem'form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
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

                    // Get the employee's id
                    $emp_id = $_SESSION['e_id'];
                    // Get all the projects the employee is assigned to
                    $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id';";
                    // Put the result in result
                    $result2 = mysqli_query($conn, $sql); 
                    // Go through each result
                    while ($row = $result2->fetch_assoc()) {
                        // Get the project id
                        $project_id = $row['project_id'];
                        // Find the project with that id
                        $sql = "SELECT project_name FROM projects WHERE project_id = '$project_id';";
                        // Put the result into $result3
                        $result3 = mysqli_query($conn, $sql);
                        // Go through the result
                        while ($row2 = $result3->fetch_assoc()) {
                            // Get the project name
                            $project_name = $row2['project_name'];
                        }
                        // Put the project into an option
                        echo "<option value='$project_id'>$project_name</option>";
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
            <textarea name='desciption' id='description' style='margin-top:-15px;float:left;width: 658px;height: 60px;'></textarea>
        </div>
        <div style='height:50px; margin-left:20px;'>
            <button type='sumbit' id='save_new_entry' name='project_submit' style='float:right; margin-right:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Save</button>
        
            <button id='cancel_edit_entry' style='float:right; margin-right:20px;width: 100px;
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

<?php
    include_once 'footer.php';
?>



