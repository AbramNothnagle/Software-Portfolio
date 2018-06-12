<?php
    // Put the header in the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['e_id'])) {
        // if not, exit the code
        exit;
    }
    // Get the employee's id 
    $_SESSION['current_emp_id'] = $_SESSION['e_id'];
?>

<!-- Get the jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get the jquery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Get the moment library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<!-- Get the calendar -->
<script src='fullcalendar/fullcalendar.js'></script>
<!-- Get the styling for the calendar -->
<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
<!-- Get the stylesheet style.css -->
<link rel="stylesheet" type="text/css" href="style.css">

<!-- Main part of page -->
<section style='padding-top:40px;'>
    <div class="centered-wrapper">          

        <script>
            // When page is ready, do this
            $(document).ready(function() {
                
                // Start the calendar section
                var calendar = $('#calendar').fullCalendar({
                    
                    // Set the header options
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month, agendaWeek, agendaDay'
                    },
                    
                    // Load the entries into the page
                    events: 'load.php',

                    // What happens if an event is clicked
                    eventClick:function(event) {
                        // Get the event's project  
                        event_project = event.project;
                        // Get the event's location
                        event_location = event.location;
                        // Get the event's description
                        event_description = event.description;
                        // Put the description into the des id
                        document.getElementById('des').innerHTML = event_description;
                        // Put the project into the pro id
                        document.getElementById('pro').innerHTML = event_project;
                        // Put the location into the loc id
                        document.getElementById('loc').innerHTML = event_location;
                        // Display the info modal called myInfo
                        $(document.getElementById('myInfo')).css('display','block');
                    },


                    // Displays location, description, and project on event element if the view is in week or day
                    eventRender: function( event, element, view ) {
                        var view = $('#calendar').fullCalendar('getView');
                        var view_string = view.title;
                        if (view_string.indexOf(',') > -1) { 
                            element.find('.fc-title').append("<p style='font-size:10px;'>" + "<br>Location: " + event.location + "<br>Project: " + event.project + "<br>Description: " + event.description + "</p>");
                        }
                    }
                });
                // ----- End calendar -----





                // What happens if the X is clicked on the myInfo modal
                $( "#close_info" ).click(function() {
                    // Stop display the myInfo modal
                    $(document.getElementById('myInfo')).css('display','none');
                })

                // What happens if the request schedule change button is clicked
                $( "#request_change" ).click(function() {
                    // Stop display the myInfo modal
                    $(document.getElementById('myInfo')).css('display','none');
                    // Display the request_change_modal
                    $(document.getElementById('request_change_modal')).css('display','block');
                })

                // What happens if the cancel button is clicked on the request_change_modal
                $( "#cancel_request" ).click(function() {
                    // Stop displaying the request_change_modal        
                    $(document.getElementById('request_change_modal')).css('display','none');
                          
                })

                // What happens when you click the submit button of the request_change_modal
                $( "#submit_request" ).click(function() {
                    // Stop displaying the request_change_modal  
                    $(document.getElementById('request_change_modal')).css('display','none');
                    // Get the chosen date
                    date = $('#date_request').val()
                    // Get the time of day chosen
                    time = $('#time_request').val()
                    // Get the message they are sending
                    message = $('#message').val()
                    // AJAX request to put the message into the database
                    $.post( "employee_request.php", {date:date,time:time,message:message});
                            
                })
            });  
            // ----- End (document).ready -----


            // Start the continuous clock at the top of the page. It ticks once per a second
            setInterval(function(){ continuous_clock() }, 1000);
            // Put the clock into a variable
            var clockDisplay = document.getElementById('world_clock');
            // Set the clock to the current time
            clockDisplay.innerHTML = moment().format('hh:mm:ss A');
            // Function to run clock at the top of the page that displays the time
            function continuous_clock() {
                // Put the clock into a variable
                var clockDisplay = document.getElementById('world_clock');
                // Set the clock to the current time
                clockDisplay.innerHTML = moment().format('hh:mm:ss A');
            }

        </script>





        <!-- Create the top header that says Calendar -->
        <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
            <div id='top-bar' style='margin-left:20px;'>
                <h1 style='float:left; font-size:20px; line-height:40px; font-family: arial;'>Calander</h1>
            </div>
        </div>

        <!-- Create a 50px tall white area -->
        <div class='box-create' style='width:100%; height:50px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style=''>
            </div>
        </div>

        <!-- Create the calendar section with a white background -->
        <div class='box-create' style='width:100%; height:780px; background-color:rgb(247, 247, 247)'>
            <div id='top-bar' style='margin-left:20px; margin-right:20px;'>
                <div class="container">
                    <div id="calendar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End main part of page -->


















<!-- Hidden modals -->

<!-- myInfo is an info modal to display infomation on an event that is clicked, it also contains a button
     to request a schedule change -->
<div id="myInfo" class="info" style='
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 5; /* Sit on top */
    left:0px;
    top: 0%;
    width: 100%;
    height:100%;
    background-color: rgba(0,0,0,0.5);
    overflow: auto; /* Enable scroll if needed */'>
    <!-- Modal content -->
    <div class="modal-content" style=' background-color:#fff;width:500px;; margin: 0 auto; margin-top:5%;'>
        <div style='margin-left:20px; margin-right:20px;'>
            <div style='height:20px;'>
                <span style='margin-top:20px;float:right;' id='close_info'>&times;</span>
            </div>
            <div>
                <p style='width:50px; margin: 0 auto;'>Info</p>
            </div>
            <br>
            <div style='height:30px;'>
                <p style='float:left;'>Location: &nbsp</p>
                <p style='float:left;' id='loc'></p>
            </div>
            <br>
            <div style='height:30px;'>
                <p style='float:left;'>Project: &nbsp</p>
                <p style='float:left;' id='pro'></p>
            </div>
            <br>
            <div style='height:30px;'>
                <p style='float:left;' >Description: &nbsp</p>
                <p style='float:left;' id='des'></p>
            </div>
            <button id='request_change'style='width: 60%;
                height: 30px;
                margin-bottom: 20px;
                margin-left: 20%;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                font-size: 16px;
                color: #fff;
                cursor: pointer;'>Request Schedule Change
            </button>
        </div>
    </div>
</div>
<!-- End myInfo modal -->





<!-- The request_change_modal is a modal to send a message to managers and admins to change a time schedule  -->
<div id="request_change_modal" style='    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 5; /* Sit on top */
    top: 0%;
    width: 100%;
    height:100%;
    font-size:14px;
    background-color: rgba(0,0,0,0.5);
    overflow: auto; /* Enable scroll if needed */' class="modal">
    <!-- Modal content -->
    <div style='width:704px; margin: 0 auto; height:236px; background-color:#fff; margin-top:10%;'>
            
        <div style='height:50px;'>
            <p style='float:left;margin-left:20px;padding:0;margin-top:18px;'>Enter Date Change</p>
        </div>

        <div style='height:20px;'>
            <input id='date_request' name='projectName' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:34px; width: 30%;' type=date id='start_submit'>
            <button style='float:right; margin-right:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(218, 218, 218);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Options</button>
            <input id='time_request' value='1:00' style='float:left; width: 50px; height:34px; margin-left:20px; margin-top:-15px;' type='text'>
            <select id='time_request_2' style='float:left; height:34px; margin-left:20px; margin-top:-15px;'>
                <option>AM</option>
                <option>PM</option>
            </select>
        </div>

        <div style='height:50px; margin-left:20px; '>
            <p style='float:left;padding:0;margin-top:18px;'>Description</p>

        </div>
        
        <div style='height:80px; margin-left:20px;'>
            <textarea id='message' style='margin-top:-15px;float:left;width: 664px;height: 64px;' >
            </textarea>
        </div>

        <div style='height:50px;'>
            <button id='submit_request' style='float:left; margin-left:20px;width: 100px;
                margin-top:-15px;
                height: 34px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                color: #fff;
                font-size: 14px;
                cursor: pointer;'>Submit
            </button>
        
            <button id='cancel_request' style='float:left; margin-left:20px;width: 100px;
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
<!-- End request_change_modal modal -->