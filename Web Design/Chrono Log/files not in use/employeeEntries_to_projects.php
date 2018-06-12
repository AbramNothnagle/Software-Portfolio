<?php
    include_once 'header.php';
?>

<section class="main-container">

    <?php
        include_once 'nav.php';
    ?>

    <div class="main-wrapper" style='width:70%; float:right; margin-right:20px;'>
        <link rel="stylesheet" type="text/css" href="style_now.css">
        <?php 
            
            // Checking to see if the page the user came from sent information about the employee they want to view
            if (isset($_POST['viewemployee'])){
                $_SESSION['current_emp_id'] = $_POST['emp_id'];
                $_SESSION['current_emp_first'] = $_POST['emp_first'];
                $_SESSION['current_emp_last'] = $_POST['emp_last'];
            }
            
            $emp_id = $_SESSION['current_emp_id'];
            $emp_name = $_SESSION['current_emp_name'];

        ?>

    
        <!-- Creates the top of the form where the employee's name is displayed -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='float:left; font-size:20px; line-height:40px;'><?php echo $_SESSION['current_emp_first']. ' ' . $_SESSION['current_emp_last']; ?></h1>
            </div>
        </div>


        <div class='box-create' style='width:100%; height:60px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                
                <!-- <form id='search-form' method='POST'> 
                    <button id='employee-search' type='submit' name='employee' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                    font-size: 16px;' >Search</button>
                    <input id='search-input' placeholder='Search employees'type='text' name='employee_email' style='padding: 0px 0px 0px 12px;float:right;width:30%;height:37px;margin-top:20px; margin-right:20px; font-size:16px;'>
                 </form> -->

                <!-- Creates the filter button -->
                <button id ='filter-button' name='commentSubmit' 
                    style=' width: 150px;
                    margin-top:20px;
                    height: 40px;
                    float:right;
                    margin-right:20px;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    <a style ='color:#fff;' >Filter</a>
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
                    <option>month</option>
                    <option>year</option>
                </select>

                <!-- Creates the button to go to the employee's calendar -->
                <button name='commentSubmit' 
                    style=' width: 150px;
                    margin-top:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    <a style ='color:#fff;' href='employeeshift.php'>Calendar</a>
                </button>


                <!-- Creates the button to go to the employee's project Entries-->
                <button name='commentSubmit' 
                    style=' width: 150px;
                    margin-top:20px;
                    margin-left:20px;
                    height: 40px;
                    float:left;
                    border: none;
                    background-color: rgb(66, 85, 252);
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;'>
                    <a style ='color:#fff;' href='employeeEntries.php'>Clocked Entries</a>
                </button>

                <!-- The all button -->
                <button id='all_button' name='commentSubmit' 
                    style=' width: 60px;
                    display:none;
                    margin-right:20px;
                    margin-top:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    font-size: 16px;
                    color: black;
                    cursor: pointer;'>
                    All
                </button>
            </div>
        </div>   

        <!-- Creates the button to delete selected entries if pressed -->
        <div class='box-create' style='width:100%; height:120px; background-color:rgb(247, 247, 247)'>  
            <div id='top-bar' style='margin-left:20px;'>
                <button type='submit' form='delete_selected' name='delete2' 
                style=' width: 150px;
                margin-top:20px;
                height: 40px;
                float:left;
                border: none;
                background-color: rgb(194, 194, 194);
                font-family: arial;
                font-size: 16px;
                color: #fff;
                cursor: pointer;'>
                Delete Selected
                </button>

                <button type='submit' name='delete3' 
                style=' width: 150px;
                margin-top:20px;
                height: 40px;
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
                <select id='filter-type' style='width: 150px;
                    margin-top:20px;
                    margin-right:20px;
                    height: 40px;
                    float:right;
                    border: none;
                    background-color: rgb(200, 200, 200);
                    font-family: arial;
                    font-size: 16px;'>
                    <option>cvs</option>
                    <option>excel</option>
                    <option>pdf</option>
                </select>
            </div>
        </div> 


        
        <div style ='display:none; height:54px; margin-top:-54px; background-color:rgb(247, 247, 247);width:100%;'id='filter-date-slide' class='search-results'>
            <div style='float:left; margin-top:-3px; margin-left:33%;'><button class='arrow-button' id='time-back' style=''><</button></div>
            <div style='float:right; margin-top:-3px; margin-right:33%;'><button class='arrow-button' id='time-forward' style=''>></button></div>
            <div style=''id='date-display'></div>
            <!-- <div style=''id='month-display'>March</div>
            <div style=''id='day-display'>11</div> -->
        </div>

        <div id='search-results' class='search-results'>
        
        </div>





        <!-- Begin List Div that lists all of the entries from the employee -->
        <div id='list'>

        <?php

        
        include 'includes/dbh.inc.php';
        
        // // Back Button That Takes You Back To View Employees
        // echo "<form style='position:absolute; margin-top:-65px; margin-left: -10%;' method='POST' action='view_employees.php'>
        //     <button type ='submit' name='back' style=' width: 240px;
        //     height: 30px;
        //     margin-right: 10px;
        //     border: none;
        //     background-color: #f3f3f3;
        //     font-family: arial;
        //     font-size: 16px;
        //     color: #111;
        //     cursor: pointer;'>
        //     Back to view employees</button></form>";
        
        // // Button to go to edit the employee's shifts
        // echo "<form style='position:absolute; margin-top:-100px; margin-left: -10%;' method='POST' action='employeeshift.php'>
        //     <button type ='submit' name='shifts' style=' width: 240px;
        //     height: 30px;
        //     margin-right: 10px;
        //     border: none;
        //     background-color: #f3f3f3;
        //     font-family: arial;
        //     font-size: 16px;
        //     color: #111;
        //     cursor: pointer;'>
        //     Shifts</button></form>";

        $totalHours = 0;
        $totalMinutes = 0;
        $totalSeconds = 0;

        ?><form method="POST" name='delete_selected' id='delete_selected'>
        
        <?php
       
        $sql = "SELECT * FROM time WHERE emp_id = '$emp_id';";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {
            
                
                echo "<div style='width:100%;height:54px;background-color:rgb(247, 247, 247)'>";
                echo "<div id='projectBox' style='width: 97%; height:50px;
                margin:0 auto;
                background-color: rgb(144, 223, 255);
                border-radius: 4px;font-size:16px;'>
                <p>";

                echo "<div style='float:left;margin-left:12px;'>";
                echo "First Name: ";
                echo $row['emp_first'];
                echo " | Last Name: ";
                echo $row['emp_last'];  
                echo " | time: ";         
                  
                
                $hours = $row['hours'];
                echo $hours;

                // echo " | time started: ";   
                // echo $row['time_start'];  
                // echo " | time ended: ";   
                // echo $row['time_end']; 
                echo " | Date: ";
                echo $row['date'];
                echo " | project id: ";
                echo $row['p_id'];
                echo "</div>"; 

                $tid = $row['time_id'];

                echo "</p></div>";

                echo "<button type='submit' value='$tid' form='edit' name='time_id' style=' width: 60px;
                    height: 30px;
                    position: absolute;
                    margin-top:-40px;
                    margin-left:370px;
                    border: none;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;'>Edit</button>";


                ?>
                    
                <label style = 'margin-left:945px;margin-top:-40px;' class="checkbox-container">
                    <input type="checkbox" name='num[]' value='<?php echo $row['time_id']; ?>'>
                    <span class="checkmark"></span>

                </label>
                
                    
                    <!-- <input type='checkbox' name='num[]' value='<?php echo $row['time_id']; ?>' style='position:absolute; margin-top:-50px; margin-left: 34%;height: 50px;
                    width: 50px;'> -->
                <?php
                echo "</div>";

            
        }
       
        ?>
        <!-- <input type ='submit' value='Delete Selected'name='delete2' style='width: 150px; position:absolute; left:153px; top:200px;
            width: 150px;
            margin-top:20px;
            height: 40px;
            border: none;
            background-color: rgb(252, 61, 61);
            font-family: arial;
            font-size: 16px;
            color: #fff;
            cursor: pointer'> -->
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

    </div>
    <!-- End list Div -->

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
    });




</script>

</div>









<?php
    include_once 'footer.php';
?>



