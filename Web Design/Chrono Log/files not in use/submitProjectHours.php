<?php
    include_once 'header.php';
?>
           
<section class="main-container">
    <div class="main-wrapper">          
        <h3>Submit hours<h3>
       
        <?php
            
            include 'includes/dbh.inc.php';           
            if (isset($_POST['time_id'])){
                $_SESSION['time_id']= $_POST['time_id'];
            }

            // Finds the date that this clock in period occured at and puts it into $date
            $tid = $_SESSION['time_id'];
            $sql = "SELECT * FROM timeGeneral WHERE time_id = '$tid';";
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
                $date = $row['date'];
            }

            // Adds all the hours clocked for the date
            $eid = $_SESSION['e_id'];
            $sql2 = "SELECT * FROM timeGeneral WHERE emp_id = $eid";
            $result2 = mysqli_query($conn, $sql2);
            $totalHours = 0;
            while ($row = $result2->fetch_assoc()) {
                if ($row['date']===$date){    
                    $totalHours += $row['hoursTotal'];
                }
            }     
            
            // Adds all the hours submitted for the date
            $totalHours2 = 0;
            $sql3 = "SELECT * FROM time WHERE emp_id = $eid";
            $result3 = mysqli_query($conn, $sql3);
            while ($row = $result3->fetch_assoc()) {
                if ($row['date']===$date){     
                    $totalHours2 += $row['hours'];
                }
            }     
            
            // Formats the hours clocked and submitted to 4 decimal places
            $hoursformat = number_format($totalHours, 4, '.', '');
            $totalHours2 = $totalHours - $totalHours2;
            $hoursformat2 = number_format($totalHours2, 4, '.', '');
    
            // Gets all projects from the database
            $org_name = $_SESSION['e_org_name'];
            $sql = "SELECT * FROM projects";
            $result = mysqli_query($conn, $sql);
        
            // Area to submit hours worked on a project
            echo"<div style = 'width:950px height:40px; background-color:white;'><form method='POST' action='".setTimes($conn)."'>
                <p style='margin-left:5px; font-size: 12px; float:left;'>$date |</p><p style='font-size: 12px;float:left;'>Hours Clocked: $hoursformat |</p><p id='hours_left' style='font-size: 12px;float:left;'>Hours Left To Submit: $hoursformat2</p><br>
                <input type='text' style='height:25px; margin-bottom:0px;' name='hours' placeholder='hours'> 
                <input type='text' style='height:25px; margin-bottom:0px;' name='description' placeholder='description'>
                <input type='hidden' name='date' value='$date'>
                <input type='hidden' name='hours_clocked' value='$totalHours2'>";    
            
            // Creates the drop down menu to select the project
            echo "<select name='projectId' style='margin-left:5%;';'>";
            while ($row = $result->fetch_assoc()) {
                if ($row['org_name']===$org_name){
                    $project = $row['project_name'];
                    $projectId = $row['user_id'];

                    echo "<option value='$projectId'>$project</option>";   
                }
            }
            echo "</select>";
            
            // Button to submit your hours
            echo"<button type='submit' name='time'
                id='submit' 
                style=' width: 180px;
                height: 30px;
                margin-left: 29%;
                border: none;
                background-color: #f3f3f3;
                font-family: arial;
                font-size: 16px;
                color: #111;
                cursor: pointer;'>
                Submit time</button>
                </form></div>";
            
            /*
            echo "<div style='margin-left:0%; margin-top:-56px;'>
            <ul>
            <li onclick='dropDown()'style='cursor: pointer;list-style: none;line-height:30px;font-size:20px;width:180px;height:30px;margin-left:45%;margin-top:20px;background-color:orange;'>Projects</li>
            ";
            echo"<ul id='projects' style='display:none;margin-top:21px;margin-left:78px;'>";
            while ($row = $result->fetch_assoc()) {
                if ($row['org_name']===$org_name){
                    $project = $row['project_name'];
                    echo "<li class='projectList' style='position:relative;margin-top:-21px;margin-left:-178px;'><button onclick='dropDown()'style='position:absolute;width:180px;height:30px;'>$project</button></li>";   
                }
            }
            
            echo"</ul></li></ul>";
            echo "</div";
            */

            //echo "total hours worked today: ".$totalHours."<br>";
            //echo "total hours submited for today: ".$totalHours2;

            $_SESSION['clockedTime'] = $totalHours;
            $_SESSION['sumbitTime'] = $totalHours2;

            // Inserts into the database the submitted data
            function setTimes($conn){
                echo '<script type="text/javascript">',
                    'refresh();',
                    '</script>';
            
                if(isset($_POST['time'])){
                
                    $id = $_POST['projectId'];
                    $first = $_SESSION['e_first'];
                    $last = $_SESSION['e_last'];
                    $hours = $_POST['hours'];
                    $date = $_POST['date'];
                    $des = $_POST['description'];
                    $eid = $_SESSION['e_id'];
                    $totalHours2 = $_POST['hours_clocked'];

                    // Checks to make sure the hours submitted doesn't go over the hours clocked for that day
                    if (0 < $totalHours2 - $hours){
                        $sql = "INSERT INTO time (emp_first, emp_last, p_id, hours, emp_id, des, date) VALUES ('$first','$last','$id', '$hours','$eid','$des','$date')";
                        $result = mysqli_query($conn, $sql);
                    // Tells the employee the hours submitted is too high
                    } else {
                    echo "You have entered more hours than you've clocked.";
                    }
                }
        }

        ?>



    </div>
</section>
    <script>
        
        /*
        var open = 'false';
        function dropDown(){
            if (open == 'true'){
                document.getElementById('projects').style.display = "none";
                open = 'false';
            } else{
                document.getElementById('projects').style.display = "block";
                open = 'true';
            }
        }
        */

        // functions to refresh the page
        function refresh(){
            setTimeout(function(){ refreshNow() }, 100);
        });
        function refreshNow(){
            window.location.reload();
        };
        
    </script>
<?php
    include_once 'footer.php';
?>

