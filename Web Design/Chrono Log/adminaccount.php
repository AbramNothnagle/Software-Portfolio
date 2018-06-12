<?php
    // Add the header into the page
    include_once 'header.php';
    // Check to make sure an admin is logged in
    if (!isset($_SESSION['u_id'])) {
        // If not, exit the code
        exit;
    }
?>

<!-- Main part of page -->
<section class="main-container">
    <div class='centered-wrapper'>
        <h2>Create Another Admin Account</h2>
        <!-- Form to create a new admin account -->
        <form class="signup-form" action="includes/signupNewAdmin.inc.php" method="POST">
            <!-- Box to enter the admin's first name -->
            <input type="text" name="first" placeholder="Firstname">
            <!-- Box to enter the admin's last name -->
            <input type="text" name="last" placeholder="Lastname">
            <!-- Box to enter the admin's E-mail -->
            <input type="text" name="email" placeholder="E-mail">
            <!-- Box to enter the admin's username that they can use to log in -->
            <input type="text" name="uid" placeholder="Username">
            <!-- Box to enter the admin's password that they will use to log in to that account -->
            <input type="password" name="pwd" placeholder="Password">
            
            <!-- Start php -->
            <?php
                // Get the id of the company that the user has that is making the new admin account
                $org_id = $_SESSION['u_org_id'];
                // Put a hidden input to send out the company id
                echo "<input type='hidden' name='org_id' value='$org_id'>";
            ?>
            <!-- End php -->

            <!-- Button to submit the form that makes the account -->
            <button type="submit" name="submit">Create</button>
        </form>
    </div>

    <div class='info_accounts_box'>
        <h5>Admin account: Free to create</h5>
        <h5>Manager account: Free to create</h5>
        <h5>Employee account: $1.50/month</h5>
    </div>

</section>
<!-- End of main part of page -->



<!-- Start PHP -->
<?php

    // Checks to see if they just attempted to create an account
    if (isset($_SESSION['admin_account_created'])) {
        // Get the result value
        $result = $_SESSION['admin_account_created'];
        // Checks to see if they just successfully created an account
        if ($result == 'true') {
            echo "
             
                <div class='disappear_modal' style='width:500px; margin: 0 auto; height:50px; margin-top:-435px;background-color:#fff;z-index:6; border:1px solid rgb(177, 177, 177);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);' >
                    <div style='margin-left:50%; margin-left: 64px; margin-top: 15px;> 
                        <p style=';padding:0;color:black; font-size:20px; line-height:40px;'>ADMIN ACCOUNT CREATED SUCCESSFULLY</p>
                    </div
                </div>

            ";
        }
        // Unset as they have seen the message
        unset($_SESSION['admin_account_created']);
    }
        
?>
<!-- End PHP -->