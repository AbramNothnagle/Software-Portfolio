<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Edit Entry</h2>
      
        <?php
            
            echo "<form style='position:absolute; margin-top:-65px; margin-left: -10%;' method='POST' action='viewHours.php'>
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
            <textarea style='width:300px;height:80px;' type='text' value='' name='newEntryDescription'>New Description Here</textarea><br>
            Date <input type='date' name='newEntryDate'>
            Hours <input type='text' name='newHours'>
            <button name='submit' type='submit'>Edit</button>
            
            
            </form>";
        
            function editEntry($conn){
                 
                if (isset($_POST['submit'])){
                    $new_entry_des = $_POST['newEntryDescription'];
                    $tid = $_SESSION['tid'];
                    $new_date = $_POST['newEntryDate'];
                    $hours = $_POST['newHours'];
                    $result = mysqli_query($conn, "UPDATE time SET des='$new_entry_des' WHERE time_id = '$tid'");
                    $result2 = mysqli_query($conn, "UPDATE time SET date='$new_date' WHERE time_id = '$tid'");
                    $result3 = mysqli_query($conn, "UPDATE time SET hours='$hours' WHERE time_id = '$tid'");
                }
            }
        ?>

    </div>
</section>

<?php
    include_once 'footer.php';
?>



