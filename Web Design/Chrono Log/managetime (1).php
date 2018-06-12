<?php
    include_once 'header.php';
    include 'includes/dbh.inc.php';
?>

<link rel="stylesheet" type="text/css" href="style_now.css">

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





<section class="main-container">



    <div class="centered-wrapper">
    <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
        <div id='top-bar' style='margin-left:20px;'>
            <h1 style='float:left; font-size:20px; line-height:40px;'>Manage Time</h1>
        </div>
    </div>
    
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
                            
                            $emp_id = $_SESSION['e_id'];
                            $sql = "SELECT * FROM assignment_employees WHERE emp_id = '$emp_id';";
                            $result2 = mysqli_query($conn, $sql); 

                            while ($row = $result2->fetch_assoc()) {
                                $project_name = $row['project_name'];
                                $project_id = $row['project_id'];
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
            <!-- <select style='width: 150px;
                margin-top:20px;
                height: 40px;
                float:left;
                border: none;
                background-color: rgb(200, 200, 200);
                font-family: arial;
                font-size: 16px;'>
                <option>all</option>
                <option>week</option>
                <option>month</option>
                <option>year</option>
                
            </select> -->

            <!-- <button name='commentSubmit' 
                style=' width: 150px;
                margin-top:20px;
                height: 40px;
                float:left;
                margin-left:20px;
                border: none;
                background-color: rgb(66, 85, 252);
                font-family: arial;
                font-size: 16px;
                color: #fff;
                cursor: pointer;'>
                <a style ='color:#fff;' href='employeeshift.php'>Filter</a>
            </button> -->

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
                echo " | Project name: ";
                echo $row['project_name'];
                echo "</div>";
            
                $tid = $row['time_id'];
                
                // Creates the info button to get the information on an entry
                echo "<button type='submit' value='$tid' form='edit' name='time_id' style=' width: 100px;
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
                cursor: pointer;'>Projects</button>";
                
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

        /*
        $finalSeconds = ($totalSeconds % 60);
        $totalSeconds = $totalSeconds - $finalSeconds;
        $totalMinutes = $totalMinutes + ($totalSeconds / 60);
        $finalMinutes = ($totalMinutes % 60);
        $totalMinutes = $totalMinutes - $finalMinutes;
        $finalHours = $totalHours + ($totalMinutes / 60);
        
        echo "Total Time: <br>";
        if ($finalHours  < 10){
            echo "0".$finalHours .":";
        } else {
            echo $finalHours .":";
        }
        if ($finalMinutes < 10){
            echo "0".$finalMinutes.":";  
        } else {
            echo $finalMinutes.":";
        }
        if ($finalSeconds  < 10){
            echo "0".$finalSeconds; 
        } else {
            echo $finalSeconds;
        }
        */

       ?>

    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function readyDoc() {
        $( ".info_button_managetime" ).click( function() {
    
            time_id = $(this).val();
            $("#entry_info").load("load_entry_info.php", { time_id:time_id } );
            $("#info_modal").css("display","block");
            
        });
        $( "#exit_data" ).click( function() {
    
            $("#info_modal").css("display","none");
            
        });

    });

    
</script>


<?php
    include_once 'footer.php';
?>



