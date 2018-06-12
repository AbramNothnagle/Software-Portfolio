<?php
    include_once 'header.php';
?>
<link rel="stylesheet" type="text/css" href="style.css">
<section class="main-container">
    <div class="main-wrapper">          
        <h3>Calender<h3>
       
        


        <div id='calender' style='width: 100%; height: 40%; background-color:white; margin: 0 auto;'>
            
            <p style='font-size: 10px;'></p>

        </div>
        
        <!--
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: 5%; margin-left: 0%;'>
        Sun
        </div>
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: -5%; margin-left: 15%;'>
        Mon
        </div>
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: -5%; margin-left: 29%;'>
        Tues
        </div>
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: -5%; margin-left: 43%;'>
        Wen
        </div>
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: -5%; margin-left: 57%;'>
        Thur
        </div>
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: -5%; margin-left: 71%;'>
        Fri
        </div>
        <div style ='width: 12%; height: 20%; background-color: #cad8ca; margin-top: -5%; margin-left: 86%;'>
        Sat
        </div>
        <button style='font-size: 50px; position:absolute; left: 4%; top: 30%;'><</button>
        <button style='font-size: 50px; position:absolute; left: 92%; top: 30%;'>></button>
        -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    
    header:{
     left:'prev,next today',
     center:'title',
     right:'month, agendaWeek, agendaDay'
    },
    events: 'load.php',




    // Displays location, description, and project on event element if the view is in week or day
    eventRender: function( event, element, view ) {
        var view = $('#calendar').fullCalendar('getView');
        var view_string = view.title;
        if (view_string.indexOf(',') > -1){
            element.find('.fc-title').append("<p style='font-size:10px;'><br>Project: " + event.project + "<br>Description: " + event.description + "<br>Location: " + event.location + "</p>");
            }
   },
   
   });
  });



   
  </script>

  <br />
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>

       
       
       
       
       
       
       
       <?php 
       $_SESSION['current_emp_id'] = $_SESSION['e_id'];
        /*   
            
            class Calendar{
                private $month;
                private $year;
                private $days_of_week;
                private $num_days;
                private $date_info;
                private $day_of_week;
            

                public function __construct( $month, $year, $days_of_week = array('s','m','t','w','th','f','sa')){

                    $month_next = $month + 1;
                    $month_last = $month - 1;
                    $year2 = $year;
                    $year3 = $year;

                    if ($month_last == 0){
                        $month_last = 12;
                        $year2 = $year - 1;
                    }
                    if ($month_next == 13){
                        $month_next = 1;
                        $year3 = $year - 1;
                    }

                    $this->month = $month;
                    $this->year = $year;
                    $this->days_of_week = $days_of_week;
                    $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
                    $this->num_days_last = cal_days_in_month(CAL_GREGORIAN, $this->month_last, $this->year2);
                    $this->num_days_next = cal_days_in_month(CAL_GREGORIAN, $this->month_next, $this->year3);
                    $this->date_info = getDate(strtotime('first day of', mktime(0,0,0,$this->month,1,$this->year)));
                    $this->day_of_week = $this->$date_info['wday'];
                    $this->date_info2 = getDate(strtotime('first day of', mktime(0,0,0,$this->month_last,1,$this->year2)));
                    $this->day_of_week2 = $this->$date_info['wday'];
                }


                public function show(){
                // Month and year caption
                $output = '<table class="calendar"';
                $output .= '<caption>' . $this->date_info['month'] . ' ' . $this->year . '</caption>';
                $output .= '<tr>';

                
                

                $today = date('y-m-d', time());
                
                
                // Days of the week header
                
                foreach( $this->days_of_week as $day ){
                    $output .= '<th class = "header">' . $day . '</th>';
                }
                

                // Close header row and open first row of days
                $output .= '</tr><tr>';

                // If the first day of the month does not fall on a sunday, then we need to fill
                // beginning space using colspan
                
                if ( $this->day_of_week > 0 ){
                    $output .= '<td colspan="' . $this->day_of_week . '"></td>';
                }

                
                // Start num_days counter
                $current_day = 1;

                // Loop and build days
                while ( $current_day <= $this->num_days ) {
                    // reset 'day of week' counter 
                    if ( $this->day_of_week == 7 ){
                        $this->day_of_week = 0;
                        $output .= '<.tr><tr>';
                    }
                
                    // Build each day cell
                    $output .= '<td class="day">' . $current_day . '</td>';

                    // Increment counters
                    $current_day++;
                    $this->$day_of_week++;
                }
                
                // Once num_days counter stops, if day of week counter is not 7, then we
                // need to fill the remaining space on the row using colspan
                if ( $this->day_of_week !=7 ){
                    $remaining_days = 7 - $this->$day_of_week;
                    $output .= '<td colspan="' . $remaining_days . '"></td>';
                }

                // Close final row and table
                
                $output .= '</tr>';
                $output .= '</table>';

                // Output this ish;
                echo $output;
                $getdate = getdate(mktime(null, null, null, $this->$month, 1, $this->$year));
                echo $getdate["weekday"];
            }
        }

        $calendar = new Calendar(2, 2018);
        $calendar->show();
        */
        ?>

         


        </section>

<?php
    include_once 'footer.php';
?>

