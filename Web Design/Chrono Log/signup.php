<?php
    // Put the header in the page
    include_once 'header.php';
    // Start a session
    session_start();
?>

<!-- Start main part of page -->
<section class="main-container">
    <div class="centered-wrapper">
        <h2>Signup for Admins</h2>
        <form class="signup-form" action="includes/signup.inc.php" method="POST">
            <input type="text" name="first" placeholder="Firstname">
            <input type="text" name="last" placeholder="Lastname">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="org" placeholder="Company Name">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
</section>



<!-- Start PHP -->
<?php
    
    // Checks to see if they just attempted to create an account
    if (isset($_SESSION['new_admin_created'])) {
        // Get the result value
        $result = $_SESSION['new_admin_created'];
        // Checks to see if they just successfully create an account
        if ($result == 'true') {
            echo "
             
                <div class='disappear_modal' style='width:500px; margin: 0 auto; height:50px; margin-top:-435px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <div style='margin-left:50%; margin-left: 64px; margin-top: 15px;> 
                        <p style=';padding:0;color:black; font-size:20px; line-height:40px;'>NEW ACCOUNT AND COMPANY CREATED SUCCESSFULLY</p>
                    </div
                </div>

            ";
        }
        // Unset as they have seen the message
        unset($_SESSION['new_admin_created']);
    }
        
?>
<!-- End PHP -->

<?php
    // Put the footer in the page
    include_once 'footer.php';
?>