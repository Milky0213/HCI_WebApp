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
      <link rel="stylesheet" href="orders_style.css">
   </head>
   <body>
        <!--Cleaner than placing navbar on every page-->
         <?php include 'config_navbar.php'; ?>       
      <main>
        
        <!--Div for positioning title-->
         <div class="namedef">
            <h1 class="name">Orders</h1>
         </div>
      </main>
      <div class= "table_container">
         <form class="search" method="post" action="orders.php">
            <!--Search bar-->
            <input type ="text" id="myInput" onkeyup="searchFunction()" placeholder="Search customer name..."> 
            <!--Script sourced through W3 Schools - (https://www.w3schools.com/howto/howto_js_filter_table.asp)-->
            <script>
                function searchFunction() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("orders_table");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide rows that don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
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
                <h2>Add an Order</h2>
                <br />
                <br />
                <br />

                <form method="post" action="orders.php">
                    <label>Staff Name:</label>
                    <select name="order_staff_name">

                    <?php

                    $sql = mysqli_query($connectdb, "SELECT staff_id, name FROM staff");

                    while ($row = $sql->fetch_assoc()){

                    echo "<option value='{$row['staff_id']}'>{$row['name']}</option>";

                    }

                    ?>

                    </select>
                    <br />
                    <br />
                    <label>Customer Name:</label>
                    <select name="order_customer_name">

                    <?php

                    $sql = mysqli_query($connectdb, "SELECT customer_id, name FROM customers");

                    while ($row = $sql->fetch_assoc()){

                    echo "<option value='{$row['customer_id']}'>{$row['name']}</option>";

                    }

                    ?>

                    </select>
                    <br />
                    <br />
                    <label>Order Date:</label>
                    <input type="date" required name="order_date" />
                    <br />
                    <br />
                    <button class="new_record_submit" type="submit" id="new_record_submit" name="submit_order">
                    <p>Submit new Order</p>
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
         
         <table width="100%" class="orders_table" id="orders_table">
            <thead>
               <tr>
                  <th>Order ID</th>
                  <th>Staff</th>
                  <th>Customer</th>
                  <th>Date</th>
                  <th></th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <?php
$sel_query = "SELECT o.order_id, s.name AS staff, c.name AS customer, 
o.order_date AS date
FROM orders o
INNER JOIN staff s
ON o.staff_id = s.staff_id
INNER JOIN customers c 
ON o.customer_id = c.customer_id
GROUP BY o.order_id;";
$result = mysqli_query($connectdb, $sel_query);
while ($row = mysqli_fetch_assoc($result))
{ ?>
            <tr>
               <!--Displaying data from the database through echo-->
               <td><?php echo $row["order_id"]; ?></td>
               <td><?php echo $row["staff"]; ?></td>
               <td><?php echo $row["customer"]; ?></td>
               <td><?php echo $row["date"]; ?></td>
               <td>
                <form action="view_order.php" method="post">
                    <input type="hidden" method="post" value="<?php echo $row['order_id']; ?>">
                    <input class="view_order" type="submit" name="view_order" value="View Order">
                </form>
               </td>
               <td>
                <form action="orders.php" method="post">
                    <input type="hidden" name="del_id" value="<?php echo $row['order_id']; ?>" />
                    
                    <input class="delete" type="submit" name="delete_row" value="Delete">
                </form>
               </td>
               <td>
                <form action="edit_order.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['order_id']; ?>" />
                    <input type="hidden" name="edit_staff_name" value="<?php echo $row['staff']; ?>" />
                    <input type="hidden" name="edit_customer_name" value="<?php echo $row['customer']; ?>" />
                    <input type="hidden" name="edit_date" value="<?php echo $row['date']; ?>" />
                    <!--Button to edit a record-->
                    <input class="edit_record" type="submit" name="edit_row" value="Edit">
                </form>
               </td>
            <tr>
               <?php
} ?>
         </table>         
        <!--//To delete customers-->
         <?php
if (isset($_POST['delete_row']))
{
    //Grabs id of input
    $rowOrdId = $_POST['del_id'];
    //Query to delete the row that matches the customer_id of the selected row
    $sql = "DELETE FROM orders WHERE order_id='$rowOrdId'";
    //Refreshes page to show new records
    if (mysqli_query($connectdb, $sql))
    {
        echo "<div class='alert alert-good'>
            <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
            </span>Order deleted successfully!
          </div>";
        //Error message if customer has an active order and is present in another table as a foreign key
        
    }
    else
    {
        echo "<div class='alert alert-bad'>
            <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
            </span>This order could not be deleted, please contact your database administrator
          </div>";
    }
}

?>
      </div>
      
      </div>
      <!--Creating new record php script-->
      <?php
if (isset($_POST['submit_order']))
{

    $staff_name = $_POST['order_staff_name'];
    $customer_name = $_POST['order_customer_name'];
    $order_date = $_POST['order_date'];
    //Queries to grab the id rather than the name as the orders table only takes their id
    $new_record = "INSERT INTO orders (staff_id, customer_id, order_date) VALUES ('$staff_name', '$customer_name', '$order_date')";
    if (mysqli_query($connectdb, $new_record))
    {
        echo
        //By setting onclick to both display=none and location.reload, the webpage reloads and displays the new data and then pops the notification up
        "<div class='alert alert-good'>
                        <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
                        </span>New Order saved successfully!
                      </div>";
    }
    else
    {
        echo "<div class='alert alert-bad'>
                 <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
                 </span>There was an issue adding this order
               </div>";
    }
}
?>
      </div>
      <!--If a user scrolls down a lot then this button takes them back to the top-->
      <a class="gotopbtn" href="#">Back to Top</a>
   </body>
</html>
