<?php
    // Put header in the page
    include_once 'header.php';
    // Check if no one is signed in
    if (!isset($_SESSION['u_id']) && !isset($_SESSION['e_id']) && !isset($_SESSION['m_id'])) {
        include 'emplogin.html';
    }
?>

<!-- Main part of page -->
<section class="main-container">
    <div style='width:1000px; margin:0 auto; '>
        
        <link rel="stylesheet" type="text/css" href="style_now.css">
        
        <?php
            
            // -------------------------------- Checks if an Admin is logged in --------------------------------
            if (isset($_SESSION['u_id'])) {

                // Creates the database connect
                include 'includes/dbh.inc.php';

                // Gets the users id
                $user_id = $_SESSION['u_id'];
                // Gets the company id
                $org_id = $_SESSION['u_org_id'];
                // Gets the company settings
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql); 
                // Go through the results
                while ($row = $result->fetch_assoc()) {
                    // Get the company name
                    $org_name = $row['org_name'];
                    // Gets the company website address
                    $org_website = $row['org_website'];
                    // Gets if the company allows employees to edit entries
                    $allow_employee_edit = $row['allow_employee_time_edit'];
                    // Gets if the company allows managers to edit entries
                    $allow_manager_edit = $row['allow_manager_time_edit'];
                }

                
                // Diplays the name of the company
                echo "<div style='width: 700px; height:55px;
                    margin-bottom: 50px;
                    margin: 0 auto;
                    border-radius: 4px'>";
                echo "<h2>Home</h2>";
                echo "Company Name: <h2 id='company_name_header'>".$org_name."</h2><br><br>";
                
                // More space
                echo "</div><br><br><br>";


                //include 'project.php';
                
                // --- Creates three columns for the home page buttons to be displayed on ---
                echo "<div class ='columns' style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>";
                

                // --- 1st row : images ---
                echo "<div><img src='images/employee.png' height='42' width='42'></div>";
                echo "<div><img src='images/manager.png' height='42' width='42'></div>";
                echo "<div><img src='images/admin.png' height='42' width='42'></div>";
                // --- End 1st row --- 


                // --- 2nd row : buttons ---
                // Button to create a new employee account
                echo "<a href='eaccount.php'>Create Employee Account</a>";
                
                // Button to create a new manager account
                echo "<a href='manager_account.php'>Create Manager Account</a>";

                // Button to create a new admin account
                echo "<a class='home_page_button' href='adminaccount.php'>Create Admin Account</a>";
                // --- End 2nd row ---


                // --- 3rd row: buttons ---
                // Button to view employees in your company
                echo "<a href='view_employees.php'>View Employees</a>";

                // Button to view managers in your company
                echo "<a href='view_managers.php'>View Managers</a>";

                echo "<div></div>";
                // --- End 3rd row ---

                
                // --- 4th row : buttons ---
                // Button to view who is currently clocked in
                echo "<a href='view_clocked_in.php'>View Employees Clocked In</a>";
                echo "<div></div><br><br>";
                
                // --- End 4th row ---
                
                
                // --- 5th row: images ---
                echo "<div><img src='images/projects.png' height='42' width='42'></div>";
                echo "<div><img src='images/calendar.png' height='42' width='42'></div>";
                echo "<div><img src='images/database.png' height='42' width='42'></div>";
                // --- End 5th row ---


                // --- 6th row: buttons ---
                // Button to view projects 
                echo "<a href='view_projects.php'>Projects</a>";

                // Button to view the main calender 
                echo "<a href='main_calendar.php'>Calendar</a>";

                // Button to view database information 
                echo "<a href='database_options.php'>Database Options</a>";
                // --- End 6th row --- 


                // --- 7th and 8th row: empty ---
                echo "<div></div><div></div><br><br>";
                // --- End 7th and 8th row --- 


                // --- 9th row : images ---
                echo "<div><img src='images/notifications.png' height='42' width='42'>";
                echo "</div><div><img src='images/settings.png' height='42' width='42'></div>";
                echo "<div></div>";
                // --- End 9th row ---


                // --- 10th row : buttons ---
                // Button to view notifications 
                echo "<button id='notifications' >Notifications</button>";
                // Button to view settings
                echo "<button id='settings'>Settings</button>";
                // --- End 10th row ---


                echo "</div>";
                // --- End columns ---


                // Gets all of the messages for the company that are unread
                $sql = "SELECT * FROM message WHERE org_id = '$org_id' AND read_status='No';";   
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql);     
                // Get the number of results from the database. This is the number of unread messages
                $resultCheck = mysqli_num_rows($result);  

                $pixels = 165+($resultCheck*54);

                // If there is 1 or more unread messages, display a redbox with the number of unread messages in the notifications button
                if ($resultCheck > 0) {
                    echo "<div style='position:absolute;background-color:red; color:#fff; margin-left:40px; margin-top:-40px; z-index:5; font-size:16px;height: 30px; width: 34px; line-height:30px;'>$resultCheck</div>";
                }

                // More space
                echo "<br><br><br>";
            
            // -------------------------------- End of Admin Code --------------------------------

                   

                

        
            
            // -------------------------------- Checks if an Employee is logged in --------------------------------
            } elseif (isset($_SESSION['e_id'])){
                
                // Connects to databse
                include 'includes/dbh.inc.php';
                
                
                // Tells the employee they are home and logged in
                
                echo "<h2>Home</h2>";
                echo 'Employee logged in <br>';
                
                // Diplays the name of the company
                echo "<div>";
                echo "company name : ";
                //echo $_SESSION['e_org_name'];

                // Gets the company id
                $org_id = $_SESSION['e_org_id'];
                // Gets the company settings
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql); 
                // Go through the results
                while ($row = $result->fetch_assoc()) {
                    // Get the company name
                    $company_name = $row['org_name'];
                } 
                echo $company_name;

                echo "</div>";

                echo "<div style=''>";
                    include 'clock.php';
                echo "</div>";
                // Some space
                echo "<br>";
                
                // Button to take employee to their calender
                echo "<form action='calender.php'>
                    <button style=' width: 150px;
                    position:absolute;
                    top:61px;
                    left:130px;
                    height: 39px;
                    border: none;
                    margin:0 auto;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;'>Calender
                    </button></form><br> ";
                
                // Button to take employee to manage time
                echo "<form action='managetime.php'><button style=' width: 150px;
                    height: 39px;
                    position:absolute;
                    top:101px;
                    left:130px;
                    border: none;
                    margin:0 auto;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;'>Manage Time</button></form> ";
                echo "<div class='clocked_alerts'><div id='clocked_alert_area'><h5>History</h5></div>";
                

            // -------------------------------- End of Employee Code --------------------------------







            // -------------------------------- Checks if a Manager is logged in --------------------------------
            } elseif (isset($_SESSION['m_id'])){

                // Connects to databse
                include 'includes/dbh.inc.php';
                
                
                echo "<h2>Home</h2>";
                echo "Manager Logged In!";
                // Diplays the name of the company
                echo "<div>";
                echo "company name : ";

                // Gets the company id
                $org_id = $_SESSION['m_org_id'];
                // Gets the company settings
                $sql = "SELECT * FROM company_info_and_settings WHERE org_id = '$org_id'"; 
                // Gets the result from the database              
                $result = mysqli_query($conn, $sql); 
                // Go through the results
                while ($row = $result->fetch_assoc()) {
                    // Get the company name
                    $company_name = $row['org_name'];
                } 
                echo $company_name;

                echo "</div>";
                echo "<br><br>";
                
                
                // --- Creates three columns for the home page buttons to be displayed on ---
                echo "<div class ='columns' style='display:grid; grid-template-columns: 33.33% 33.34% 33.33%'>";

                echo "<div><img src='images/employee.png' height='42' width='42'></div>";
                echo "<div><img src='images/projects.png' height='42' width='42'></div>";
                echo "<div></div>";

                // Button to view employees you are assigned
                echo "<a href='view_assigned_employees.php'>View Employees</a>";
                
                // Button to view projects you are assigned
                echo "<a href='view_assigned_projects.php'>View Projects</a>";

                echo "</div>";
                // --- End Colomns --- 

            // -------------------------------- End of Manager Code --------------------------------






            

            // If no one is logged in, display the employee loggin box
            } else {
                echo "<br>";
                echo "<link href='https://fonts.googleapis.com/css?family=Unica+One' rel='stylesheet'>";
                echo "<br><br><br><br><h1 style='font-size: 90px';>TIME KEEPING</h1>";
            }
        ?>

    </div>
</section>
<!-- End main part of page -->

<!-- Get jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



<!-- Notifications modal to see messages -->
<div id='notificationsModal' class='modal' style='background-color:transparent;'>

    <div style='display:block;' class='outside_of_modal'></div>
    <!-- Modal content -->

    <div class='centering-modal'>
        <div style=<?php echo"height:".$pixels."px;"?> class='moveable_modal' id='movable_notificationsModal'>

            
            <div id='movable_notificationsModalheader'style='cursor: move;height:40px;background-color: rgb(66, 85, 252);'>
                <p style='float:left;margin-left:20px;padding:0; color:white; font-size:20px; line-height:40px;'>Notifications</p>
            </div>

            <div style='height:20px;'>
            </div>

            <div id='search-results'>

            </div>


            <?php ?>
            <div style='height:50px; margin-left:20px;margin-top:0px;'>
                <button id='all_notifications' style='width: 150px;
                    margin-top:-10px;
                    height: 34px;
                    float:left;
                    border: none;
                    background-color: rgb(218, 218, 218);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>All Notifications</button>

                <button id='cancel' style='width: 150px;
                    margin-top:-10px;
                    margin-left:20px;
                    height: 34px;
                    float:left;
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




       
<div id='notificationsModal_all' class='modal'>
    <!-- Modal content -->
    <div style='width:55%; margin: 0 auto; height:18%; background-color:#fff; margin-top:10%;'>
    
        <div style='height:80px;'>    
            <p style='margin-left:20px; position:absolute; margin-top:18px;'>All Notifications</p>   
        </div>

        <div id='search-results-all'>
        </div>
        

        <div style='height:50px; margin-left:20px;margin-top:-36px;'>
            <button id='new_notifications' style='width: 150px;
                margin-top:-15px;
                height: 34px;
                float:left;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>New Notifications</button>

            <button id='cancel_all' style='width: 100px;
                margin-top:-15px;
                margin-left:20px;
                height: 34px;
                float:left;
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


<div id='settingsModal' class='modal'>
    <!-- Modal content -->
    <div style='width:696px; margin: 0 auto; height:170px; background-color:#fff; margin-top:10%;'>

        <div style='height:80px;'>
            
            <p style='margin-left:20px; position:absolute; margin-top:5px; font-size:24px;'>Settings</p>
            
        </div>

        <div  id='company_info_button'style='height:34px; ;margin-top:-36px;'>
            <button class='setting_button' style='width: 200px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Company Info</button>
        </div>


        <div  id='company_notifications_button' style='height:34px;'>
            <button class='setting_button' id='' style='width: 200px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Notifications</button>
        </div>

        <div  id='company_permisions_button' style='height:34px;'>
            <button class='setting_button' id='' style='width: 200px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Permisions</button>
        </div>

        <div  style='height:34px;'>
            <button class='setting_button' style='width: 200px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Advanced</button>
        </div>
    </div>
        
    
        <div id='company_info' style='width:500px;margin-left:477px; height:134px; background-color:#fff; margin-top:-136px; border: 2px solid black;'>
            <div style='height:35px;'>
                <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Company Name</p>
                    <?php 
                        echo "<input id='company_name' value='$org_name' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:4px; height:15px; width: 60%;' type=text>";
                    ?>
            </div>


            <div style='height:35px; margin-left:20px;'>
                <p style='float:left;padding:0; margin-top:5px;'>Company Website</p>
                    <?php
                        echo "<input id='company_website' value='$org_website' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:4px; height:15px; width: 60%;' type=text>";
                    ?>
            </div>
        </div>
        
        <div id='company_notifications' style='display:none;width:500px;margin-left:477px; height:134px; background-color:#fff; margin-top:-136px; border: 2px solid black;'>
            <div style='height:35px;'>
                <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Notify Employees when to work over phone: </p>
                <input name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit'>
            </div>
        </div>

        <div id='company_permisions' style='display:none;width:500px;margin-left:500px; height:134px; background-color:#fff; margin-top:-136px; border: 2px solid black;'>
            <div style='height:35px;'>
                <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Let Employees edit time: </p>
                    <?php
                        if ($allow_employee_edit == 'yes') {
                            echo "<input value='true' id='employee_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit' checked>";
                        } else {
                            echo "<input value='true' id='employee_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit'>";
                        }
                    ?>
            </div>
            <div style='height:35px;'>
                <p style='float:left;margin-left:20px;padding:0; margin-top:5px;'>Let Managers edit time: </p>
                    <?php
                        if ($allow_manager_edit == 'yes') {
                            echo "<input value='true' id='manager_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit' checked>";
                        } else {
                            echo "<input value='true' id='manager_allow_edit' style='padding: 0 0 0 4px; float:left; margin-left:10px; margin-top:7px;' type=checkbox id='start_submit'>";
                        }
                    ?>
                
            </div>
        </div>

        <div style='width:694px; margin: 0 auto; height:40px; background-color:rgb(218, 218, 218); margin-top:0%; border:none;'>
            <div style='height:40px; margin-right:20px;float:right;'>
                <button id='save_settings' style='width: 100px;
                    margin-top:3px;
                    height: 34px;
                    border: none;
                    background-color:  rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    margin-right:15px;
                    font-size: 14px;
                    cursor: pointer;'>Save
                </button>
                <button id='cancel_settings' style='width: 100px;
                    margin-top:3px;
                    height: 34px;
                    border: none;
                    background-color:  rgb(66, 85, 252);
                    font-family: arial;
                    color: #fff;
                    font-size: 14px;
                    cursor: pointer;'>Exit
                </button>
            </div>
        </div>
</div>



<script>

    $(document).ready(function readyDoc() {    
        
        // Default settings to info
        var settings = 'info';


        // What happens when notifications is clicked       
        $( "#notifications" ).click(function() {  
            // Display the notifications modal
            $(document.getElementById('notificationsModal')).css('display','block');
            // Load in the messages and add click handlers to the buttons on them
            $('#search-results').load('search_messages.php', function() { add_click_handlers(); });
        })
        // What happens if you click the cancel button 
        $( "#cancel" ).click(function() {  
            
            location.reload();
            
        })
        $( "#cancel_all" ).click(function() {  
            
            location.reload();
            
        })

        // What happens if the setting button is clicked
        $( "#settings" ).click(function() {  
            
            $(document.getElementById('settingsModal')).css('display','block');
            
        })

        $( "#cancel_settings" ).click(function() {  
            
            location.reload();
            
        })

        $( "#company_notifications_button" ).click(function() {  
            
            // Set settings to notifications
            settings = 'notifications'
            $(document.getElementById('company_info')).css('display','none');
            $(document.getElementById('company_notifications')).css('display','block');
            $(document.getElementById('company_permisions')).css('display','none');
        
        })

        $( "#company_info_button" ).click(function() {  
    
            // Set settings to info
            settings = 'info'
            $(document.getElementById('company_info')).css('display','block');
            $(document.getElementById('company_notifications')).css('display','none');
            $(document.getElementById('company_permisions')).css('display','none');
        
        })


        $( "#all_notifications" ).click(function() {  
            

            $('#search-results-all').load('all_messages.php');
            $(document.getElementById('notificationsModal')).css('display','none');
            $(document.getElementById('notificationsModal_all')).css('display','block');
            $(document.getElementById('company_permisions')).css('display','none');
        
        })
        $( "#new_notifications" ).click(function() {  
            

            $(document.getElementById('notificationsModal')).css('display','block');
            $(document.getElementById('notificationsModal_all')).css('display','none');
        
        })
        $( "#company_permisions_button" ).click(function() {  
            
            // Set the settings to permissions
            settings = 'permissions'
            $(document.getElementById('company_info')).css('display','none');
            $(document.getElementById('company_notifications')).css('display','none');
            $(document.getElementById('company_permisions')).css('display','block');
        
        })




        $( "#save_settings" ).click(function() {  

            // Check what settings panel is being saved
            if (settings == 'info') {
                // Get the new company name
                company_name = $("#company_name").val()
                // Update the company name on the page
                $("#company_name_header").text(company_name)
                // Get the new company website
                company_website = $("#company_website").val()
                // Update the settings in the database
                $.post('update_company_settings_info.php', {company_name:company_name,company_website:company_website});
                
            } else if (settings == 'permissions') {
                if ($('#employee_allow_edit').prop('checked')) {
                    employee_allow_edit = 'yes'
                }  else {
                    employee_allow_edit = 'no';
                }
                if ($('#manager_allow_edit').prop('checked')) {
                    manager_allow_edit = 'yes'
                }  else {
                    manager_allow_edit = 'no';
                }
                $.post('update_company_settings.php', {employee_allow_edit:employee_allow_edit,manager_allow_edit:manager_allow_edit});
            }
            $(document.getElementById('settingsModal')).css('display','none');

        })
        // What happens if you click outside the edit project modal
        $( ".outside_of_modal" ).click(function() {
            // Stop displaying data_modal
            $(document.getElementById('myModal')).css('display','none');
            $(document.getElementById('notificationsModal')).css('display','none');
            
        })



        
        //Make the DIV element draggagle, makes data_modal draggable :
        dragElement(document.getElementById(("movable_notificationsModal")));

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






    function add_click_handlers() {
        $( ".read" ).click(function() {  
            
            message_id = $(this).val();
            $.post( "employee_request_checked.php", {message_id:message_id});
            $(this).css('background-color','grey');
            $(this).css('disabled','true');

        })
    }



</script>












