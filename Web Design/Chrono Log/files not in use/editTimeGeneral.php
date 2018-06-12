<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Edit Entry</h2>
      
        <?php
            
            echo "<form style='position:absolute; margin-top:-65px; margin-left: -10%;' method='POST' action='employeeEntries.php'>
            <button type ='submit' name='back' style=' width: 240px;
            height: 30px;
            margin-right: 10px;
            border: none;
            background-color: #f3f3f3;
            font-family: arial;
            font-size: 16px;
            color: #111;
            cursor: pointer;'>
            Back to view entries</button></form>";
        
            
            include 'includes/dbh.inc.php';
            $time_id = $_POST['time_id'];
            if (isset($_POST['time_id'])){
                $_SESSION['tid'] =  $time_id;
            }

            //$description = mysqli_query($conn, "SELECT des FROM time WHERE time_id=$time_id");

            echo "<form method='POST' action='".editEntry($conn)."'>
            <br>
            
            Hours <input type='text' name='newHours'>
            Minutes <input type='text' name='newMinutes'>
            Seconds <input type='text' name='newSeconds'>
            <button name='submit' type='submit'>Edit</button>
            
            
            </form>";
        
            function editEntry($conn){
                 
                if (isset($_POST['submit'])){
                   
                    $tid = $_SESSION['tid'];
                    
                    $hours = $_POST['newHours'];
                    if ($_POST['newMinutes'] < 60){
                        $min = $_POST['newMinutes'];           
                        if ($_POST['newSeconds'] < 60){
                            $sec = $_POST['newSeconds'];  
                            $result = mysqli_query($conn, "UPDATE timeGeneral SET seconds='$sec' WHERE time_id = '$tid'");
                            $result2 = mysqli_query($conn, "UPDATE timeGeneral SET minutes='$min' WHERE time_id = '$tid'");
                            $result3 = mysqli_query($conn, "UPDATE timeGeneral SET hours='$hours' WHERE time_id = '$tid'");
                        } else {
                            echo "Invalid Entry"; 
                        }
                    } else {
                        echo "Invalid Entry";
                    }

                }
            }
        ?>

    </div>
</section>

<?php
    include_once 'footer.php';
?>



