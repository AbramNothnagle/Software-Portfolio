<?php
    include_once 'header.php';
?>
           
<section class="main-container">
    <div class="main-wrapper">          
        <h3>Submit hours for this project<h3>
       
        <?php
            echo "project name: ";
            
            if(isset($_POST['submitHours'])){
                $_SESSION['project_id'] = $_POST['project_id'];
                $_SESSION['project_name'] = $_POST['project_name'];
            }
           
            $project_name = $_SESSION['project_name'];
            echo $project_name;
            include 'includes/dbh.inc.php';           
            $date = date('j F Y');
     
            $eid = $_SESSION['e_id'];
            $sql2 = "SELECT * FROM timeGeneral WHERE emp_id = $eid";
            $result2 = mysqli_query($conn, $sql2);
    
            $totalHours = 0;
            while ($row = $result2->fetch_assoc()) {
                if ($row['date']===$date){     
                    $totalHours += $row['hoursTotal'];
                }
            }     
            
            $totalHours2 = 0;
            $sql3 = "SELECT * FROM time WHERE emp_id = $eid";
            $result3 = mysqli_query($conn, $sql3);
            while ($row = $result3->fetch_assoc()) {
                if ($row['date']===$date){     
                    $totalHours2 += $row['hours'];
                }
            }     
            
            echo
            "<form method='POST' action='".setTimes($conn)."'>
            <input type='text' style='height:25px; margin-bottom:-12px;' name='hours' placeholder='hours'> 
            <input type='text' style='height:25px; margin-bottom:-12px;' name='description' placeholder='description'>".
            $date.    
            "<button type='submit' name='time' 
            style=' width: 180px;
            height: 30px;
            margin-right: 10px;
            border: none;
            background-color: #f3f3f3;
            font-family: arial;
            font-size: 16px;
            color: #111;
            cursor: pointer;'>
            Submit time</button>
            </form>";
            

            echo "total hours worked today: ".$totalHours."<br>";
            echo "total hours submited for today: ".$totalHours2;

            $_SESSION['clockedTime'] = $totalHours;
            $_SESSION['sumbitTime'] = $totalHours2;

            function setTimes($conn){
            if(isset($_POST['time'])){
                
                $id = $_SESSION['project_id'];
                $first = $_SESSION['e_first'];;
                $last = $_SESSION['e_last'];
                $hours = $_POST['hours'];
                $dec = $_POST['description'];
                $date = date('Y-m-j');
                $eid = $_SESSION['e_id'];

                $clocked = $_SESSION['clockedTime'];
                $submit = $_SESSION['submitTime'];

                $sql3 = "SELECT * FROM work";
                $result3 = mysqli_query($conn, $sql3);
                
                while($row = $result3->fetch_assoc()) {
                    if ($row['user_id'] === $id) {
                        $currentHours = $row['hours'];
                    }
                }
                
                if ($clocked >= $submit + $hours){
                    $newTotalHours = $currentHours + $hours;
                    $sql2 = "UPDATE work SET hours=$newTotalHours WHERE user_id = $id";
                    $result2 = mysqli_query($conn, $sql2);
    
                    $sql = "INSERT INTO time (emp_first, emp_last, p_id, hours, des, date, emp_id) VALUES ('$first','$last','$id', '$hours','$dec','$date','$eid')";
                    $result = mysqli_query($conn, $sql);
                    
                } else {
                    echo "<br><br>You have submited more hours for today than you have clocked.<br><br>";
                }
                header("Location: /submitHours.php");
            
              
            }
            }
            
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>

