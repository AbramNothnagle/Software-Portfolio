<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Edit Project</h2>
      
        <?php
            include 'includes/dbh.inc.php';
            $project_id = $_POST['project_id'];
            $project_name = $_POST['project_name'];
            if (isset($_POST['editproject'])){
                $_SESSION['pid'] =  $project_id;
            }
            echo $project_name;
            echo "<form method='POST' action='".editProject($conn)."'>
            <textarea style='width:300px;height:80px;' type='text' value='$project_name' name='newProjectName'>".$project_name."</textarea><br>
            <input type='date' value='$date' name='newProjectDate'>
            <button name='submit' type='submit'>Edit</button>
            
            
            </form>";
        
            function editProject($conn){
                 
                if (isset($_POST['submit'])){
                    $new_project_name = $_POST['newProjectName'];
                    $pid = $_SESSION['pid'];
                    $new_date = $_POST['newProjectDate'];
                    echo $new_project_name;
                    echo " ";
                    echo $new_date;
                    $result = mysqli_query($conn, "UPDATE work SET project_name='$new_project_name' WHERE user_id = '$pid'");
                    $result2 = mysqli_query($conn, "UPDATE work SET date='$new_date' WHERE user_id = '$pid'");
                }
            }
        ?>

    </div>
</section>

<?php
    include_once 'footer.php';
?>



