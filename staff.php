<?php
//Connects to QmireSystems Database
include 'config.php';
//Check if user is logged in or out
include 'configlogin.php';

?>
<html>
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible">
      <!--Google fonts-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="staff_style.css">
   </head>
   <body>
        <!--Cleaner than placing navbar on every page-->
         <?php include 'config_navbar.php'; ?>       
      <main>
        
        <!--Div for positioning title-->
         <div class="namedef">
            <h1 class="name">Staff</h1>
         </div>
      </main>
      <div class= "table_container">
         <form class="search" method="post" action="staff.php">
            <!--Search bar-->
            <input type ="text" id="myInput" onkeyup="searchFunction()" placeholder="Search staff name..."> 
            <!--Script sourced through W3 Schools - (https://www.w3schools.com/howto/howto_js_filter_table.asp)-->
            <script>
                function searchFunction() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("staff_table");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide rows that don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }
                }
                }
            </script>
         </form>
         <!--Button to create a new record-->
         <button id="myBtn" class="new_record">New Record<img class="new_record_icon" src="./images/new_record.png"></button>
         <div id="myModal" class="modal">
            <div class="modal-content">
               <span class="close">&times;</span>
                <h2>Add Staff</h2>
                <br />
                <br />
                <br />
                <form method="post" action="staff.php">
                    <label>Name:</label>
                    <input type="text" required name="staff_name" />
                    <br />
                    <br />
                    <label>Username:</label>
                    <input type="text" required name="staff_username" />
                    <br />
                    <br />
                    <label>Address:</label>
                    <input type="text" required name="staff_address" />
                    <br />
                    <br />
                    <label>Position:</label>
                    <input type="text" required name="staff_position" />
                    <br />
                    <br />
                    <label>Branch_id:</label>
                    <select required name="staff_branchid">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>               
                    </select>
                    <br />
                    <br />
                    <button class="new_record_submit" type="submit" id="new_record_submit" name="submit_staff">
                    <p>Submit</p>
                    </button>
                </form>
            </div>
         </div>
         <!--Sourced code from stack - (https://jsfiddle.net/m5Lbdjg7/)-->
         <script>
            var modal = document.getElementById("myModal");
            
            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks on the button, open the modal
            btn.addEventListener("click", function() {
            modal.style.display = "block";
            });
            
            // When the user clicks on <span> (x), close the modal
            span.addEventListener("click", function() {
            modal.style.display = "none";
            });
            
            // When the user clicks anywhere outside of the modal, close it
            window.addEventListener("click", function(event) {
            if (event.target == modal) {
            modal.style.display = "none";
            }
            });
         </script>
         
         <table width="100%" class="staff_table" id="staff_table">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Address</th>
                  <th>Position</th>
                  <th>Branch</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <?php
$sel_query = "SELECT s.staff_id, s.name, s.username, s.address, s.position, b.name AS branch FROM staff s 
INNER JOIN branches b ON s.branch_id = b.branch_id;";
$result = mysqli_query($connectdb, $sel_query);
while ($row = mysqli_fetch_assoc($result))
{ ?>
            <tr>
               <!--Displaying data from the database through echo-->
               <td><?php echo $row["staff_id"]; ?></td>
               <td><?php echo $row["name"]; ?></td>
               <td><?php echo $row["username"]; ?></td>
               <td><?php echo $row["address"]; ?></td>
               <td><?php echo $row["position"]; ?></td>
               <td><?php echo $row["branch"]; ?></td>
               <td>
                <form action="staff.php" method="post">
                    <input type="hidden" name="del_id" value="<?php echo $row['staff_id']; ?>" />
                    
                    <input class="delete" type="submit" name="delete_row" value="Delete">
                </form>
               </td>
               <td>
                <form action="edit_staff.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['staff_id']; ?>" />
                    <input type="hidden" name="edit_name" value="<?php echo $row['name']; ?>" />
                    <input type="hidden" name="edit_username" value="<?php echo $row['username']; ?>" />
                    <input type="hidden" name="edit_address" value="<?php echo $row['address']; ?>" />
                    <input type="hidden" name="edit_position" value="<?php echo $row['position']; ?>" />
                    <!--Button to edit a record-->
                    <input class="edit_record" type="submit" name="edit_row" value="Edit">
                </form>
               </td>
            <tr>
               <?php
} ?>
         </table>         
        <!--//To delete staff-->
         <?php
if (isset($_POST['delete_row']))
{
    //Grabs id of input
    $rowStfId = $_POST['del_id'];
    //Query to delete the row that matches the staff_id of the selected row
    $sql = "DELETE FROM staff WHERE staff_id='$rowStfId'";
    //Refreshes page to show new records
    if (mysqli_query($connectdb, $sql))
    {
        echo "<div class='alert alert-good'>
            <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
            </span>Staff deleted successfully!
          </div>";
        //Error message if staff has an active order and is present in another table as a foreign key
        
    }
    else
    {
        echo "<div class='alert alert-bad'>
            <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
            </span>This staff is in an active order, please delete the order first
          </div>";
    }
}

?>
      </div>
      
      </div>
      <!--Creating new record php script-->
      <?php
if (isset($_POST['submit_staff']))
{

    $staff_name = $_POST['staff_name'];
    $staff_username = $_POST['staff_username'];
    $staff_address = $_POST['staff_address'];
    $staff_position = $_POST['staff_position'];
    $staff_branchid = $_POST['staff_branchid'];

    $new_record = "INSERT INTO staff (name, username, address, position, branch_id) VALUES ('$staff_name', '$staff_username', '$staff_address', '$staff_position', '$staff_branchid')";
    if (mysqli_query($connectdb, $new_record))
    {
        echo
        //By setting onclick to both display=none and location.reload, the webpage reloads and displays the new data and then pops the notification up
        "<div class='alert alert-good'>
                        <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
                        </span>New Staff saved successfully!
                      </div>";
    }
    else
    {
        echo "<div class='alert alert-bad'>
                 <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
                 </span>There was an issue adding this staff
               </div>";
    }
}
?>
      </div>
      <!--If a user scrolls down a lot then this button takes them back to the top-->
      <a class="gotopbtn" href="#">Back to Top</a>
   </body>
</html>
