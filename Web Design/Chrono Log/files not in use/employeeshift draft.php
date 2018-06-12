<?php
    include_once 'header.php';

?>
<link rel="stylesheet" type="text/css" href="style.css">
<section class="main-container">
    <div class="main-wrapper">          
        <h3>employee shifts<h3>

        

    <div id='id'>
    
    <?php
        //echo $_SESSION['current_emp_id'];
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
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    eventSources:[

        // your event source
        {
            url: 'load.php', // use the `url` property
            color: '#5fa5e7',    // an option!
            textColor: 'white'  // an option!
        }],

    selectable:true,
    //weekends: false, // Hides the weekends
    selectHelper:true,
    eventLimit: true,

    eventRender: function( event, element, view ) {
        var view = $('#calendar').fullCalendar('getView');
        var view_string = view.title;
        if (view_string.indexOf(',') > -1){
            element.find('.fc-title').append("<p style='font-size:10px;'><br>Project: " + event.project + "<br>Description: " + event.description + "<br>Location: " + event.location + "</p>");
        }
    },
    
    select: function(start, end, allDay)
    {
    $('#description').val('None');
    $('#location').val('None');
    $('#title').val('None');
    $('#start_submit').val('Default');
    $('#end_submit').val('Default');
    //var title = prompt("Enter Event Title", "Event Name");
    //event.description = 'this is test';
    $(document.getElementById('myModal')).css('display','block');
    var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    $( "#cancel" ).click(function() {
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        return;
    })
    $( "#close" ).click(function() {
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        return;
    })
    $( "#submit" ).click(function() {
        var title = $('#title').val()
        var description = $('#description').val()
        var project = $('#project').val()
        var location = $('#location').val()
        var recurring = $('#recurring').val()
        var id = event.id;
        var dow = '';
        var start_submit = $('#start_submit').val()
        var end_submit = $('#end_submit').val()
        
        if (start_submit != 'Default'){
            start_submit = start_submit + ":00";
            start = start.substring(0, 11) + start_submit;
        }
        
        if (end_submit != 'Default'){
            end_submit = end_submit + ":00";
            end = end.substring(0, 11) + end_submit;
        }



        // if (start_submit != 'none'){
        //     start.setHours(start_submit);
        // }
        // if (end_submit != 'none'){
        //     end.setHours(end_submit);
        // }
        // alert(start);



        // if (recurring == 'weekdays'){
        //     dow = '[1,2,3,4,5]';
        //     start = "5:00";
        //     end = "7:30";
        // } else if (recurring == 'weekends') {
        //     dow = '[0,6]';
        //     start = $.fullCalendar.formatDate(start, "HH:mm:ss");
        //     end = $.fullCalendar.formatDate(end, "HH:mm:ss");
        // }


        $.ajax({
            url:"insert.php",
            type:"POST",
            data:{title:title, description:description, project:project, location:location, start:start, end:end, emp_id:emp_id, dow:dow},
            success:function()
            {
             calendar.fullCalendar('refetchEvents');
             //alert("Added Successfully");
            }
        })
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        return;
    })
    
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
     

    $( "#info" ).click(function() {
        
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        //$(document.getElementById('myInfo')).css('display','block');
    })
    // $(document).click(function(e) {
    //     unbinding();
    //     $(document.getElementById('myModal')).css('display','none');
    //     $(document).unbind('click');
    // });

    /*
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end, emp_id:emp_id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //alert("Added Successfully");
       }
      })
     }
    */



    },
    

    editable:true,

    // When an event is resized
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       //alert('Event Update');
      }
     })
    },


    // When an event is dragged 
    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       //alert("Event Updated");
      }
     });
    },













    eventClick:function(event)
    {  
    $(document.getElementById('myModal')).css('display','block');
    $('#description').val(event.description);
    $('#project').val(event.project);
    $('#location').val(event.location);
    $('#title').val(event.title);
    $( "#cancel" ).click(function() {
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        return;
    })
    $( "#close" ).click(function() {
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        return;
    })
    
    // Clicking on the submit button
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

        // alert(start);
        // alert(start_submit);
        // if (start_submit != 'none'){
        //     alert(start.substring(0, 10) + start_submit);
        // }
        // if (end_submit != 'none'){
        //     end.setHours(end_submit);
        // }

        $.ajax({
            url:"update_submit.php",
            type:"POST",
            data:{title:title, location:location, project:project, description:description, id:id, recurring:recurring},
            success:function()
            {
                calendar.fullCalendar('refetchEvents');
                //alert("Event Updated");
            }
        });
        $(document.getElementById('myModal')).css('display','none');
        unbinding();
        return;
    })
    
    // Clicking on the delete button
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

    // Clicking on the info button
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

     /*
     if(confirm("Are you sure you want to remove it?"))
     {
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
     }
     */
    },

   });
  });
    






    function unbinding(){
        $( "#submit").unbind('click');
        $( "#cancel" ).unbind('click');
        $( "#delete" ).unbind('click');
        $( "#close" ).unbind('click');
        $( "#info" ).unbind('click');
    }

   
  //var btn = document.getElementById("myBtn");
  </script>









    <br/>
    <br/>
    <div class="container">
    <div id="calendar"></div>
    </div>

  <!-- Trigger/Open The Modal -->

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

        <!--
        <select id='start_submit'>
            
            <option value='none'>default</option>
            <option value="01">1 AM</option>
            <option value="02">2 AM</option>
            <option value="03">3 AM</option>
            <option value="04">4 AM</option>
            <option value="05">5 AM</option>
            <option value="06">6 AM</option>
            <option value="07">7 AM</option>
            <option value="08">8 AM</option>
            <option value="09">9 AM</option>
            <option value="10">10 AM</option>
            <option value="11">11 AM</option>
            <option value="12">12 PM</option>
            <option value="13">1 PM</option>
            <option value="14">2 PM</option>
            <option value="15">3 PM</option>
            <option value="16">4 PM</option>
            <option value="17">5 PM</option>
            <option value="18">6 PM</option>
            <option value="19">7 AM</option>
            <option value="20">8 AM</option>
            <option value="21">9 PM</option>
            <option value="22">10 PM</option>
            <option value="23">11 PM</option>
            <option value="24">12 AM</option>

        </select>
        -->

        <p>End</p>
        
        <input type=text id='end_submit'>

        <!--
        <select id='end_submit'>
            
            <option value='none'>default</option>
            <option value="01">1 AM</option>
            <option value="02">2 AM</option>
            <option value="03">3 AM</option>
            <option value="04">4 AM</option>
            <option value="05">5 AM</option>
            <option value="06">6 AM</option>
            <option value="07">7 AM</option>
            <option value="08">8 AM</option>
            <option value="09">9 AM</option>
            <option value="10">10 AM</option>
            <option value="11">11 AM</option>
            <option value="12">12 PM</option>
            <option value="13">1 PM</option>
            <option value="14">2 PM</option>
            <option value="15">3 PM</option>
            <option value="16">4 PM</option>
            <option value="17">5 PM</option>
            <option value="18">6 PM</option>
            <option value="19">7 AM</option>
            <option value="20">8 AM</option>
            <option value="21">9 PM</option>
            <option value="22">10 PM</option>
            <option value="23">11 PM</option>
            <option value="24">12 AM</option>
        
        </select>
        -->

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

