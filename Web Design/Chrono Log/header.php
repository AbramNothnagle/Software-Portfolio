<?php
    // Start a session
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Put the title of the page -->
        <title></title>
        <!-- Put the stylesheet style.css on the page. This will go on every page that has a header on it -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="normalize.css">
    </head>
<body>

    <!-- Start the header -->
    <header>
        <nav>
            <div  style='width:1000px; margin:0 auto;'>

                <ul>
                    <!-- The home button to go back to the home page which is index.php -->
                    <li><a href="index.php">Home</a></li>
                </ul>
                
                <!-- The login part that is determined by what account type is logged in or if no one is logged in -->
                <div class="nav-login">
                    <!-- Start php code -->
                    <?php
                        // Check if an admin is logged in
                        if (isset($_SESSION['u_id'])) {
                            // Create loggout button for admins
                            echo '<form action = "includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                        // Check if an employee is logged in
                        } elseif (isset($_SESSION['e_id'])) {
                            // Create loggout button for employees
                            echo '<form action = "includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';

                        // Check if a manager is logged in
                        } elseif (isset($_SESSION['m_id'])) {
                            // Create loggout button for managers
                            echo '<form action = "includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit">Logout</button>
                            </form>';
                            // Else no one is logged in
                        } else {
                            // Create loggin area for someone
                            echo '
                            <form action = "includes/login.inc.php" method="POST">
                            <input type="text" name="uid" placeholder="Username/email">
                            <input type="password" name="pwd" placeholder="Password">
                            <button type="submit" name="submit">Login</button>
                            </form>
                            <a href="signup.php">Signup</a>'; 
                            
                        }

                    ?>
                    <!-- End php code -->
                </div>

                <?php 
                    // Check if an employee is logged in
                    if (isset($_SESSION['e_id'])) {
                        // Create the clock at the top
                        echo "<div id='world_clock' class='clockStyle' style='top: 20px;left:365px;font-size:22px;'>
                        </div>";
                    }
                ?>

            </div>
        </nav>
    </header>
    <!-- End of header -->