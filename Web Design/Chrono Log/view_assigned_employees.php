<?php
    // Put the header in the page 
    include_once 'header.php';
    // Connect to database
    include 'includes/dbh.inc.php';
?>



<!-- Main part of page -->
<section class="main-container">

    <?php
        include 'nav_for_managers.php';
    ?>

    <div class="main-wrapper">


            
            <!-- Displays the page name -->
            <div class='box-create' style='width:100%; height:40px; background-color:rgb(149, 149, 149)'>
                <div id='top-bar' style='margin-left:20px;'>
                    <h4>Manage Employees</h4>
                </div>
            </div>


            <div class='box-create' style='width:100%; height:62px; background-color:rgb(247, 247, 247)'>
                <div id='top-bar' style='margin-left:20px; margin-buttom:-50px;'>
                    
                    <!-- <form id='search-form' method='GET'> -->
                        <button id='employee-search' type='submit' style=' color: #fff; float:right;width: 100px; height: 40px;background-color: rgb(194, 194, 194);font-family: arial;margin-top:20px; margin-right:20px;
                        font-size: 16px;' >Search</button>
                        <input  class='searchbar-style-1' id='search-input' placeholder='Search employees'type='text' name='search'>
                    <!-- </form> -->

                        <button id='all_button'
                            style=' width: 60px; line-height:40px;
                            margin-top:20px;
                            height: 40px;
                            float:right;
                            margin-right:20px;
                            display: none;
                            border: none;
                            background-color: rgb(218, 218, 218);
                            font-family: arial;
                            font-size: 16px;
                            color: #fff;
                            cursor: pointer;'>
                            All
                        </button>
                    </div>
                </div>

                <div class='box-create' style='width:100%; height:120px; margin-top:0px; background-color:rgb(247, 247, 247)'>  
                    <div id='top-bar' style='margin-left:20px;'>
          
                        <!-- Button to make an export of the employees -->
                        <button type='submit' name='delete3' id='export'
                            style=' width: 150px;
                            margin-top:20px;
                            height: 40px;
                            line-height:40px;
                            float:right;
                            margin-right:20px;
                            border: none;
                            background-color: rgb(194, 194, 194);
                            font-family: arial;
                            font-size: 16px;
                            color: #fff;
                            cursor: pointer;'>
                            Export
                        </button>
        
                        <!-- Drop down menu to choose export type -->
                        <select style='float:right;' class='dropdown-style-1' id='export-type'>
                            <option value='csv'>csv</option>
                            <!-- <option value='excel'>excel</option>
                            <option value='pdf'>pdf</option> -->
                        </select>
                    </div>
                </div>






            <?php
                
                // Start the list div
                echo "<div id='list'>";
                echo "</div>";
                // ---- End list div ----




















            // include 'includes/dbh.inc.php';
            
            // $manager_id = $_SESSION['m_id'];
            // $sql = "SELECT * FROM assignment_managers";
            // $result = mysqli_query($conn, $sql);
            
            // while ($row = $result->fetch_assoc()) {
            //     if ($row['manager_id']===$manager_id) {
            //         if ($row['emp_id'] != null) {

            //             $emp_id = $row['emp_id'];
                       
            //             $sql2 = "SELECT * FROM employees WHERE emp_id = '$emp_id'";
            //             $result2 = mysqli_query($conn, $sql2);
            
            //             while ($row2 = $result2->fetch_assoc()) {
                            
            //                 echo "<div id='projectBox' style='width: 950px; height:35px;
            //                     padding: 5px;
            //                     margin-bottom:4px;
            //                     background-color: #fff;
            //                     border-radius: 4px;font-size:14px;'>
            //                     <p>";

            //                 echo "First Name: ";
            //                 echo $row2['emp_first'];
            //                 echo " | Last Name: ";
            //                 echo $row2['emp_last'];
            //                 echo " | Email: ";
            //                 echo $row2['emp_email'];               
                        
            //                 echo "</p></div>";
                            
            //                 echo "<form style='position:absolute; margin-top:-65px; margin-left: 60%;' method='POST' action='employee_entries_for_managers.php'>
            //                     <input type='hidden' name='emp_id' value='".$row2['emp_id']."'>
            //                     <input type='hidden' name='emp_first' value='".$row2['emp_first']."'>
            //                     <input type='hidden' name='emp_last' value='".$row2['emp_last']."'>
            //                     <button type ='submit' name='viewemployee' style=' width: 180px;
            //                     height: 30px;
            //                     margin-right: 10px;
            //                     border: none;
            //                     background-color: #f3f3f3;
            //                     font-family: arial;
            //                     font-size: 16px;
            //                     color: #111;
            //                     cursor: pointer;'>
            //                     Select Employee</button></form>";
                            
                             
            //             }
            //         }
            //     }
            // }


        ?>
    </div>
</section>

<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Get Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script>

    $(document).ready(function readyDoc() {
        
        // Initialize variables 
        var clicked_project_id, input;
        // Default searching to false 
        var searching = false;

        // Get all of the entries from the project
        $.post('load_assigned_employees_to_objects.php', function(result) {
            
            // Turn the result into JSON objects
            employees = JSON.parse(result)
            // Display all of these projects at the start of page
            display_all()
        })

        // Function to display all of the entries
        function display_all() {
            // Clear all managers
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < employees.length; i++) {
                // Get the html for the entry
                text = prepare_entry_line(employees[i].first, employees[i].last, employees[i].id, employees[i].email)
                // // Put the entry on #list
                $('#list').append(text)
            }
        }

        function display_search() {
            // Clear all managers
            $('#list').html('')
            // Go through every entry
            for (i = 0; i < employees.length; i++) {  
                // Check if the search is in the name
                if ( employees[i].email.toLowerCase().includes(input.toLowerCase()) ) {
                    // Get the html for the entry
                    text = prepare_entry_line(employees[i].first, employees[i].last, employees[i].id, employees[i].email)
                    // Put the entry on #list
                    $('#list').append(text)
                }
            }
        }

        // Create the entry lines with html
        function prepare_entry_line(first, last, id, email) {
            // Create the text needed to create an entry
            text = "<div id='entry_template' style='width:100%;height:54px;background-color:rgb(247, 247, 247);'> <div id='entry_box' style='width: 97%; height:50px;margin:0 auto; background-color: rgb(144, 223, 255);border-radius: 4px;font-size:16px;'><div id='entry_text' style='float:left;margin-left:12px;font-size:16px;'> First Name: " + first + " | Last Name: " + last + " | Email: " + email + "</div><form style='position:relative; float:right; margin-right:26px;' method='GET' action='employee_entries_for_managers.php'><input type='hidden' name='emp_id' value='" + id + "'><button type='submit' style='width: 180px;height: 30px;margin-right: 10px;border: none;background-color: #f3f3f3;font-family: arial;font-size: 16px;color: #111;cursor: pointer;'>Select Employee</button></form></div></div>";
            // Return the text
            return text
        }

        // What happens if you click the search button
        $( "#employee-search" ).click(function() {
            // Get the search typed in
            input = $('#search-input').val()
            // Clear all projects
            $('#list').html('')
            // Display the all button
            $(document.getElementById('all_button')).css('display','block');
            // Display projects that have names like the search word
            display_search()
            // Set searching to true
            searching = true;
        })

        // When happens if a key on while on the search bar is pressed
        $("#search-input").keyup(function(event) {
            // Check if it was enter
            if (event.keyCode === 13) {
                // Get the search typed in
                input = $('#search-input').val()
                // Clear all projects
                $('#list').html('')
                // Display the all button
                $(document.getElementById('all_button')).css('display','block');
                // Display projects that have names like the search word
                display_search()
                // Set searching to true
                searching = true;
            }
        })

        // What happens if the all button is clicked
        $( "#all_button" ).click(function() {
            // Display all of these projects at the start of page
            display_all()
            // Stop displaying the all button
            $(document.getElementById('all_button')).css('display','none');
            
            searching = false;
        })

        // Happens if the add project button is clicked
        $( "#add_button" ).click(function() {
            // Display the myModal modal
            $(document.getElementById('myModal')).css('display','block');
            
        })
        // What happens if the cancel button is clicked on the add new project (myModal) 
        $( "#cancel" ).click(function() {
            // Stop displaying myModal
            $(document.getElementById('myModal')).css('display','none');
            
        })



    });
</script>




<?php
    include_once 'footer.php';
?>



