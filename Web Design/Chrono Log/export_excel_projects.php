<?php
//include database configuration file
include 'includes/dbh.inc.php';

session_start();


// Get the company name
$org_name = $_SESSION['u_org_name'];

 $sql = "SELECT * FROM projects WHERE org_name='$org_name'";
 $result = mysqli_query($conn, $sql);

 if(mysqli_num_rows($result) > 0)
 {
     $_SESSION['here'] = 'here4';
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                        <th>Id</th>  
                        <th>Project Name</th>  
                        <th>Description</th>  
                        <th>Date</th>
                        <th>Hours</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                            <td>'.$row["user_id"].'</td>  
                            <td>'.$row["project_name"].'</td>  
                            <td>'.$row["description"].'</td>  
                            <td>'.$row["date"].'</td>  
                            <td>'.$row["hours"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=projects.xls');
  echo $output;
 }

?>

