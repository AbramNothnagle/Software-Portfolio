<?php
    include_once 'header.php';
?>
           
<section class="main-container">
    <div class="main-wrapper">          
        <h3>View hours for this project<h3>
       
        <?php
            
            include 'includes/dbh.inc.php';
            
            echo "project name: ";
            
            if(isset($_POST['submitHours'])){
                $_SESSION['project_id'] = $_POST['project_id'];
                $_SESSION['project_name'] = $_POST['project_name'];
            }
            
            $pid = $_SESSION['project_id'];
            $project_name = $_SESSION['project_name'];

            echo $project_name;

            // Delete Project Button
                        echo "<form style='position:absolute; left:1035px; top:21%' method='POST' action='".deleteProject($conn)."'>
                        <input type='hidden' name='project_id' value='$pid'>
                        <button type ='submit' name='delete_project' style=' width: 180px;
                        height: 30px;
                        margin-right: 10px;
                        border: 2px solid red;
                        background-color: #f3f3f3;
                        font-family: arial;
                        font-size: 16px;
                        color: #111;
                        cursor: pointer;'>
                        Delete Project</button></form>";          
            
            /*
              // Delete Selected Entries Button
              echo "<form style='position:absolute; margin-top:-100px; margin-left: 70%;' method='POST'>
        
              <button type ='submit' name='delete_project' style=' width: 180px;
              height: 30px;
              margin-right: 10px;
              border: 2px solid red;
              background-color: #f3f3f3;
              font-family: arial;
              font-size: 16px;
              color: #111;
              cursor: pointer;'>
              Delete Selected</button></form>";   
            */

            // Form to enter hours of work into a project            
            echo
            "<div id='inputEntry'><form method='POST' action='".setTimesFromViewHours($conn)."'>
            <input style='height:25px; margin-bottom:-12px;' type='text' name='hours' placeholder='hours'>
            <input style='height:25px; margin-bottom:-12px;' type='text' name='description' placeholder='description'>    
            <input style='height:25px; margin-bottom:-12px;' type='text' name='first' placeholder='first name'> 
            <input style='height:25px; margin-bottom:-12px;' type='text' name='last' placeholder='last name'>  
            <input type='date' style='height:25px; margin-bottom:-12px;' name='date'>  
            <button type='submit' name='time' 
            style=' width: 180px;
            height: 30px;
            margin-right: 10px;
            border: none;
            background-color: #f3f3f3;
            font-family: arial;
            font-size: 16px;
            color: #111;
            cursor: pointer;
            margin-bottom:4px'>
            Submit time</button>
            </form></div>";
            $totalHours = 0;



            ?><form method="POST">

            <?php
            $sql = "SELECT * FROM time";
            $result = mysqli_query($conn, $sql);
            
            // Creating the boxes that show times worked on the project
            
            while ($row = $result->fetch_assoc()) {
                if ($row['p_id']===$pid){
                
                echo "<div id='projectBox' style='width: 950px; height:35px;
                padding: 5px;
                margin-bottom:4px;
                background-color: #fff;
                border-radius: 4px;font-size:14px;'>
                <p>";
                echo "First Name: ";
                echo $row['emp_first'];
                echo " | Last Name: ";
                echo $row['emp_last']." | Hours: ";
                echo $row['hours']." | Description: ";
                echo $row['des'];
                echo " | Date: ";
                echo $row['date'];
                echo "</p></div>";
                $description = $row['des'];
                $totalHours = $totalHours + $row['hours'];
                $hoursToRemove = $row['hours'];
                $newHours = $totalHours - $hoursToRemove;
                
                // Delete Entry Button

                /*
                $tid = $row['time_id'];
                echo "<form style='position:absolute; margin-top:-60px; margin-left: 65%;' method='POST' action='".deleteTime($conn)."'>
                <input type='hidden' name='time_id' value='$tid'>
                <input type='hidden' name='hours' value='$newHours'>
                <button type ='submit' name='delete_time' style=' width: 120px;
                height: 30px;
                margin-right: 10px;
                border: none;
                background-color: #f3f3f3;
                font-family: arial;
                font-size: 16px;
                color: #111;
                cursor: pointer;'>
                Delete Time</button></form>";
                */    
                $tid = $row['time_id'];
                            // Edit Entry Button
                echo      "<button type='submit' value='$tid' form='edit' name='time_id' style=' width: 60px;
                            height: 30px;
                            position:absolute;
                            margin-left:30%;
                            margin-top:-3%;
                            border: none;
                            background-color: #f3f3f3;
                            font-family: arial;
                            font-size: 16px;
                            color: #111;
                            cursor: pointer;'>Edit</button>";


                
                ?>
                    <input type='checkbox' name='num[]' value='<?php echo $row['time_id']; ?>' style='position:absolute; margin-top:-42px; margin-left: -38%;'>
                <?php

                
                
                }
            }

            
            ?>
            <!-- Button to delete entry -->
             <input type ='submit' value='Delete Selected Entries'name='delete2' style='width: 180px; position:absolute; left:1035px; top:19%;
              height: 30px;
              margin-right: 10px;
              border: 2px solid red;
              background-color: #f3f3f3;
              font-family: arial;
              font-size: 16px;
              color: #111;
              cursor: pointer;'>
              </form>  
            
     
            
            <?php
                       
            echo "<form id='edit' method='POST' action='editEntry.php'></form>";
                        


            if (isset($_POST['delete2'])){
                $box = $_POST['num'];
                while (list ($key, $val) = @each ($box)){ 
                    mysqli_query($conn, "DELETE FROM time WHERE time_id = $val");
                }
                ?>
                    <script type="text/javascript">
                    window.location.href=window.location.href;
                    </script>

                <?php


            }


            // Shows total hours worked on the project
            echo "Total Hours: ";
            echo $totalHours;
            mysqli_query($conn, "UPDATE projects SET hours=$totalHours WHERE user_id = $pid");

            function setTimesFromViewHours($conn){
            if(isset($_POST['time'])){
                $id = $_SESSION['project_id'];
                $first = $_POST['first'];;
                $last = $_POST['last'];
                $hours = $_POST['hours'];
                $dec = $_POST['description'];
                $date = $_POST['date'];
                
                $sql3 = "SELECT * FROM work";
                $result3 = mysqli_query($conn, $sql3);
                
                while($row = $result3->fetch_assoc()) {
                    if ($row['user_id'] === $id) {
                        $currentHours = $row['hours'];
                    }
                }
                
                $newTotalHours = $currentHours + $hours;

                $sql = "INSERT INTO time (emp_first, emp_last, p_id, hours, des, date) VALUES ('$first','$last','$id', '$hours', '$dec', '$date');";
                $result = mysqli_query($conn, $sql);
                $sql2 = "UPDATE work SET hours=$newTotalHours WHERE user_id = $id";
                $result2 = mysqli_query($conn, $sql2);
            }
            }
        
            function deleteProject($conn){
                if(isset($_POST['delete_project'])){
                    $pid = $_POST['project_id'];
                    $sql = "DELETE FROM projects WHERE user_id = $pid";
                    mysqli_query($conn, $sql);
                    echo "<br><div style='border: 2px solid red;'>Project Deleted</div>";
                    header('Location: /phplessons/index.php');
                    exit();
                }
            }
            function deleteTime($conn){
                if(isset($_POST['delete_time'])){
                    $tid = $_POST['time_id'];
                    $sql = "DELETE FROM time WHERE time_id = $tid";
                    mysqli_query($conn, $sql);
                    $id = $_SESSION['project_id'];
                    $newTotalHours = $_POST['hours'];
                    $sql2 = "UPDATE projects SET hours=$newTotalHours WHERE user_id = $id";
                    $result2 = mysqli_query($conn, $sql2); 
                    
                    
                }
            }

        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>

