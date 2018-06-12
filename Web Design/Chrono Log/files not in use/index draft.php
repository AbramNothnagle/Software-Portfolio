<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Home</h2>
        <?php
            
            // Checks if an Admin is logged in
            if (isset($_SESSION['u_id'])) {

                unset($_SESSION['project_deleted']);
                $id = $_SESSION['u_id'];
                
                // Diplays the name of the company
                echo "Company Name: ".$_SESSION['u_org_name']."<br><br>";
                
                include 'includes/dbh.inc.php';
                include 'project.php';
                
                echo "<div style='display:grid; grid-template-columns: 1fr 1fr 1fr'>";
                
                echo "<div><img src='images/employee.png' height='42' width='42'></div>";
                echo "<div><img src='images/manager.png' height='42' width='42'></div>";
                echo "<div><img src='images/admin.png' height='42' width='42'></div>";
                // Button to create a new employee account
                echo "<a style='
                    display:block;
                    margin: 0 auto;
                    margin-bottom:5px;
                    width: 80%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;
                    
                    }' 
                    href='eaccount.php'>Create Employee Account</a>";
                
                // Button to create a new manager account
                echo "<a style='
                    display:block;
                    margin: 0 auto;
                    margin-bottom:5px;
                    
                    width: 80%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;
                    }' 
                    href='manager_account.php'>Create Manager Account</a>";

                // Button to create a new admin account
                echo "<a style='
                    display:block;
                    
                    margin-bottom:5px;
                    margin: 0 auto;
                    width: 80%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    
                    color: #fff;
                    cursor: pointer;
                    }' 
                    href='adminaccount.php'>Create Another Admin Account</a>";

                // Button to view employees in your company
                echo "<a style='
                    display:block;
                    margin-bottom:5px;
                    width: 80%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    margin: 0 auto;
                    
                    cursor: pointer;
                    }' 
                    href='view_employees.php'>View Employees</a>";

                // Button to view managers in your company
                echo "<a style='
                    display:block;
                    margin: 0 auto;
                    margin-bottom: 5px;
                    margin-top: 0px;
                    width: 80%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;
                    }' 
                    href='view_managers.php'>View Managers</a>";

                echo "<div></div>";

                // Button to view who is currently clocked in
                echo "<a style='
                    display:block;
                    margin: 0 auto;
                    margin-bottom:5px;
                    
                    width: 80%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    
                    color: #fff;
                    cursor: pointer;
                    }' 
                    href='view_clocked_in.php'>View Employees Clocked In</a>";

                echo "</div>";
                
                
                // Area to create a new project
                echo "<div style='border: 2px solid black; margin-top:10%;text-align:left;'><form method='POST' action='".setProject($conn)."'>
                    <input type='hidden' name='uid' value='$id'>                
                    Project Name: <textarea style='float:right; width: 300px;height: 40px;' name='projectName'></textarea><br>
                    Date: <input type='date' style='float:right;width: 300px;height: 40px;' name='date'><br>
                    <button type='submit' name='commentSubmit' 
                    style=' width: 180px;
                    height: 30px;
                    margin-right: 10px;
                    border: none;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;'>
                    Submit New Project</button>
                    </form></div>";
                

                

                // Code to put input for initial hours worked on a project
                // Hours worked on project: <input type='text' style='float:right;width: 300px;height: 40px;' name='hours'><br>
                
                // Button to view all the projects from your company
                if (!isset($_SESSION['projects_opened'])){
                echo "<div style='margin-top:10%;'><form method='POST' action='".getProject($conn)."'>
                    <button style=' width: 180px;
                    height: 30px;
                    margin-right: 10px;
                    border: none;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;type='submit' name='commentSubmit2'>My projects</button>  
                    </form></div>";
                } else {
                    getProject($conn);
                }
            
            // Checks if an Employee is logged in
            } elseif (isset($_SESSION['e_id'])){
                
                include 'includes/dbh.inc.php';
                include 'eproject.php';
                
                echo 'Employee logged in <br>';
                
                // Diplays the name of the company
                echo "company name : ";
                echo $_SESSION['e_org_name'];
                
                // Button to go to clock page
                /*
                echo "<a style='
                    display:block;
                    margin: 0 auto;
                    margin-top:5%;
                    margin-bottom:5%;
                    width: 30%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;
                    }' 
                    href='clockpage.php'>Clock In Page</a>";
                */
                
                include 'clock.php';
                
                // Some space
                echo "<br><br><br><br><br><br><br>";
                
                // Button to take employee to their calender
                echo "<form action='calender.php'><button style=' width: 300px;
                    height: 40px;
                    border: none;
                    margin-left: -15px;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;type='submit' name='goto'>Calender</button></form><br> ";
                
                // Button to take employee to manage time
                echo "<form action='managetime.php'><button style=' width: 300px;
                    height: 40px;
                    border: none;
                    margin-left: -15px;
                    background-color: #f3f3f3;
                    font-family: arial;
                    font-size: 16px;
                    color: #111;
                    cursor: pointer;type='submit' name='goto'>Manage Time</button></form> ";
                
                // Some extra space
                echo "<br><br><br><br><br><br><br>";


            // Checks if a Manager is logged in
            } elseif (isset($_SESSION['m_id'])){
                echo "Manager Logged In!";
                include 'includes/dbh.inc.php';
                
                echo "<br><br>";

                // Button to view employees you are assigned
                echo "<a style='
                    display:block;
                    margin: 0 auto;
                    margin-bottom:5px;
                    width: 30%;
                    height: 40px;
                    border: none;
                    background-color: #222;
                    font-family: arial;
                    font-size: 16px;
                    color: #fff;
                    cursor: pointer;
                    }' 
                    href='view_assigned_employees.php'>View Employees</a>";
            

            // If no one is logged in, display the employee loggin box
            } else {
                echo "<br>";
                include 'emplogin.html';
            }
        ?>

    </div>
</section>

<?php
    include_once 'footer.php';
?>



