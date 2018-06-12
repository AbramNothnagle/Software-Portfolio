<?php
    include_once 'header.php';

?>
<link rel="stylesheet" type="text/css" href="style.css">
<section class="main-container">
    <div class="main-wrapper">          
        <h3>employee shifts<h3>

    <div id='id'>
    
    <?php
        echo $_SESSION['current_emp_first'] . ' ' . $_SESSION['current_emp_last'];
    ?>

    </div>
    
    <?php
    // Back button to employee entries
    echo "<form style='position:absolute; margin-top:-65px; margin-left: -10%;' method='POST' action='employeeEntries.php'>
            <button type ='submit' name='back' style=' width: 240px;
            height: 30px;
            margin-right: 10px;
            border: none;
            background-color: #f3f3f3;
            font-family: arial;
            font-size: 16px;
            border: 2px solid black;
            color: #111;
            cursor: pointer;'>
            Back</button></form>";
    ?>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    

<script>
   
   var emp_id = <?php echo $_SESSION['current_emp_id'];?>


$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
    
        // Settings for the calendar
        editable:true,
        selectable:true,
        selectHelper:true,
        eventLimit: true,

        //themeSystem:'bootstrap3',

        // Settings for the calender's header
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay,theme'
        },
        
        // Where to get the events from and what color they are by default
        eventSources:[
        {
            url: 'load.php', 
            color: '#5fa5e7',    
            textColor: 'white'  
        }],

        // Displays location, description, and project on event element if the view is in week or day
        eventRender: function( event, element, view ) {
            var view = $('#calendar').fullCalendar('getView');
            var view_string = view.title;
            if (view_string.indexOf(',') > -1){
                element.find('.fc-title').append("<p style='font-size:10px;'><br>Project: " + event.project + "<br>Description: " + event.description + "<br>Location: " + event.location + "</p>");
            }
        },
        
        // Create custom buttons for the header
        // customButtons: {
        //     removeAll: {
        //         text: 'RA',
        //         click: function() {
                
        //             // Ask the user to confirm that the want to delete all of the events for this employee
        //             var remove = confirm("Do you really want to remove all events?");
                    
        //             if(remove == true) {
        //                 alert('You would have deleted all of your data! Silly You!');
        //                 $.ajax({
        //                     url:"delete_all.php",
        //                     type:"POST",
        //                     data:{emp_id:emp_id},
        //                     success:function() {
        //                         calendar.fullCalendar('refetchEvents');
        //                     }   
        //                 }
        //             }
        //         }
        //     }
        // },

        // customButtons: {
        //     theme: {
        //         text: 'Theme',
        //         click: function() {
        //             //themeSystem:'standard'
        //         }
        //     }
        // },

        // When an event is resized
        eventResize:function(event) {
            
            // Gets the new time of event
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            
            var title = event.title;
            var id = event.id;
            
            // Updates the time of event in database
            $.ajax({
                url:"update.php",
                type:"POST",
                data:{title:title, start:start, end:end, id:id},
                success:function() {
                    calendar.fullCalendar('refetchEvents');
                }   
            })
        },


        // When an event is dragged 
        eventDrop:function(event) {
            
            // Gets the new time of event
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        
            var title = event.title;
            var id = event.id;
            
            // Updates the time of event in database
            $.ajax({
                url:"update.php",
                type:"POST",
                data:{title:title, start:start, end:end, id:id},
                success:function() {
                    calendar.fullCalendar('refetchEvents');
                }
            });
        },







        // ------------- FIRST SUBMITTING EVENT -------------
        // What happens if an area on the calender is clicked
        select: function(start, end, allDay) {
            
            // Resets the values in the input boxs and drop-down menus
            $('#description').val('None');
            $('#location').val('None');
            $('#title').val('None');
            $('#start_submit').val('Default');
            $('#end_submit').val('Default');

            // Displays the modal
            $(document.getElementById('myModal')).css('display','block');
            
            // Get the time that the user set the event to
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        
            // What happens if the cancel button is clicked
            $( "#cancel" ).click(function() {
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
                return;
            })
        
            // What happens if the close button is clicked
            $( "#close" ).click(function() {
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
                return;
            })

            // What happens if the submit button is clicked
            $( "#submit" ).click(function() {
                
                // Gets the values put into the input boxes and drop-down menues
                var title = $('#title').val()
                var description = $('#description').val()
                var project = $('#project').val()
                var location = $('#location').val()
                var recurring = $('#recurring').val()
                var start_submit = $('#start_submit').val()
                var end_submit = $('#end_submit').val()
                
                var id = event.id;
                var dow = '';

                if (start_submit != 'Default'){
                    start_submit = start_submit + ":00";
                    start = start.substring(0, 11) + start_submit;
                }
                
                if (end_submit != 'Default'){
                    end_submit = end_submit + ":00";
                    end = end.substring(0, 11) + end_submit;
                }

            // Sends submitted infomation to the database
            $.ajax({
                url:"insert.php",
                type:"POST",
                data:{title:title, description:description, project:project, location:location, start:start, end:end, emp_id:emp_id, dow:dow},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                }
            })

                // Closes the modal
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
                return;
            })
        
            // What happens if the delete button is clicked 
            $( "#delete" ).click(function() {
                
                // Closes the modal
                $(document.getElementById('myModal')).css('display','none');
                
                // Removes the event from the database
                var id = event.id;
                $.ajax({
                url:"delete.php",
                type:"POST",
                data:{id:id},
                success:function() {
                    calendar.fullCalendar('refetchEvents');
                }
            })
                unbinding();
                return;
            })
        
            // What happens if the info button is clicked
            $( "#info" ).click(function() {      
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
            })
        },
        // ----------- END FIRST SUBMITTING EVENT -----------








        


        // ------------ EDITING AN EVENT ------------
        // When an event is clicked
        eventClick:function(event) {  
            
            // Displays the modal
            $(document.getElementById('myModal')).css('display','block');
            
            // Sets the inputs to what the user set the as when event was created
            $('#description').val(event.description);
            $('#project').val(event.project);
            $('#location').val(event.location);
            $('#title').val(event.title);
            $('#start_submit').val('Default');
            $('#end_submit').val('Default');
        
            // What happens when the cancel button is clicked
            $( "#cancel" ).click(function() {
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
                return;
            })

            // What happens when the cancel button is clicked
            $( "#close" ).click(function() {
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
                return;
            })
            
            // What happens when the submit button is clicked
            $( "#submit" ).click(function() {
                
                var title = $('#title').val()
                var description = $('#description').val()
                var project = $('#project').val()
                var location = $('#location').val()
                var recurring = $('#recurring').val()

                var start_submit = $('#start_submit').val()
                var end_submit = $('#end_submit').val()
                var start = event.start;
                var end = event.end;
                var id = event.id;

                // if (start_submit != 'Default'){
                    
                // }
                // if (end_submit != 'Default'){
                   
                // }
                // alert(start);

                $.ajax({
                    url:"update_submit.php",
                    type:"POST",
                    data:{title:title, location:location, project:project, description:description, id:id, recurring:recurring},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                    }
                });
                $(document.getElementById('myModal')).css('display','none');
                unbinding();
                return;
            })
            
            // What happens when the delete button is clicked
            $( "#delete" ).click(function() {
                $(document.getElementById('myModal')).css('display','none');
                var id = event.id;
                $.ajax({
                url:"delete.php",
                type:"POST",
                data:{id:id},
                success:function()
                {
                    calendar.fullCalendar('refetchEvents');
                //alert("Event Removed");
                }
                
            })

            unbinding();
            return;
            })
            
            var event_project, event_location, event_description;

            // What happens when the info button is clicked
            $( "#info" ).click(function() {  
                $(document.getElementById('myModal')).css('display','none');
                event_project = event.project;
                event_location = event.location;
                event_description = event.description;
                document.getElementById('des').innerHTML = event_description;
                document.getElementById('pro').innerHTML = event_project;
                document.getElementById('loc').innerHTML = event_location;
                $(document.getElementById('myInfo')).css('display','block');
                $( "#close_info" ).click(function() {
                    
                    $(document.getElementById('myInfo')).css('display','none');
                    $( "#close_info" ).unbind('click');
                })
                unbinding()
            })
        
            function info(){
                $( "#close_info" ).click(function() {
                    $(document.getElementById('myInfo')).css('display','none');
                    document.getElementById('des').innerHTML = event.description;
                    document.getElementById('pro').innerHTML = event.project;
                    document.getElementById('loc').innerHTML = event.location;
                    $( "#close_info" ).unbind('click');
                })
            }
        },
        // ---------- END EDITING AN EVENT ----------




    });
});
    




    // Removes the listening for a click on button from the modal
    function unbinding() {
        $( "#submit").unbind('click');
        $( "#cancel" ).unbind('click');
        $( "#delete" ).unbind('click');
        $( "#close" ).unbind('click');
        $( "#info" ).unbind('click');
    }

</script>









    <br/>
    <br/>
    <div class="container">
    <div id="calendar"></div>
    </div>



<!-- The Modal -->
<div id="myModal" class="modal" style='
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 5%;
    width: 30%;
    font-size:14px;
    margin: 0 auto;
    overflow: auto; /* Enable scroll if needed */'>

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id='close'>&times;</span>
        <p>Enter Event</p>
        <br>
        <p>Title</p>
        <input type=text value='None' id='title'>
        <p>Location</p>
        <input type=text value='None' id='location'>
        <p>Project</p>
    
        <!-- php to get the options for projects -->
        <?php
        include 'includes/dbh.inc.php'; 

        $org_name = $_SESSION['u_org_name'];
        $sql = "SELECT * FROM projects";
        $result = mysqli_query($conn, $sql);
            
        //var_dump($result);
        echo "<select id ='project' name='project'>";

        while ($row = $result->fetch_assoc()) {
            if ($row['org_name']===$org_name){
                $project = $row['project_name'];
                //$projectId = $row['user_id'];
                echo "<option>$project</option>";   
            }
        }
        
        echo "</select>";
        ?>
        
        <p>Description</p>
        <input type=text value='None' id='description'>
        <p>Reaccuring</p>
        
        <select id='recurring'>
            <option value="none">None</option>
            <option value="weekdays">Weekdays</option>
            <option value="weekends">Weekends</option>
        </select>

        <p>Start</p>
        
        <input type=text id='start_submit'>

        <p>End</p>
        
        <input type=text id='end_submit'>

        <button id='submit' style='width:50%;margin-left:50%;'>Save</button>
        <button id='cancel' style='width:50%;margin-top:-20px;'>Cancel</button>
        <button id='info' style='width:50%;margin-left:50%;'>Info</button>
        <button id='delete' style='width:50%;margin-top:-20px;'>Delete</button>
    </div>
</div>

<div id="myInfo" class="info" style='
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 5%;
    width: 30%;

    margin-left: 35%;
    overflow: auto; /* Enable scroll if needed */'>

<div class="modal-content">
        <span class="close" id='close_info'>&times;</span>
        <p>Info</p>
        <br>
        <p>Description</p>
        <p id='des'></p>
        <br>
        <p>Project</p>
        <p id='pro'></p>
        <br>
        <p>Location</p>
        <p id='loc'></p>

    </div>
</div>











<!--
  
<div id="startModal" class="modal2" style='
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 2; /* Sit on top */
    left: 0;
    top: 10%;
    width: 30%;
    margin: 0 auto;
    overflow: auto; /* Enable scroll if needed */'>


  <div class="modal-content2">
    <span class="close" id='close2'>&times;</span>
    <p>Enter Event</p>
    <br>
    <p>Title</p>
    <input type=text value='Title' id='title2'>
    <p>Location</p>
    <input type=text value='Location' id='location2'>
    <p>Project</p>
    <input type=text value='Project' id='project2'>
    <p>Description</p>
    <input type=text value='Description' id='description2'>
    <button id='submit' style='width:50%;margin-left:50%;'>Save</button>
    <button id='cancel' style='width:50%;margin-top:-35px;'>Cancel</button>
    <button id='delete' style='width:100%;'>Delete</button>
  </div>
</div>
-->




</div>
              
</section>

<?php
    include_once 'footer.php';
?>


function test5(){
test.innerHTML = 'I&#39m always glad to see a new approach to solidly reasoned economic theory that may be able to reach a new segment of the population. - Jim Cox';
setTimeout("test1()", 10000);
}
