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
      <link rel="stylesheet" href="products_style.css">
   </head>
   <body>
        <!--Cleaner than placing navbar on every page-->
         <?php include 'config_navbar.php'; ?>       
      <main>
        
        <!--Div for positioning title-->
         <div class="namedef">
            <h1 class="name">Products</h1>
         </div>
      </main>
      <div class= "table_container">
         <form class="search" method="post" action="products.php">
            <!--Search bar-->
            <input type ="text" id="myInput" onkeyup="searchFunction()" placeholder="Search product name..."> 
            <!--Script sourced through W3 Schools - (https://www.w3schools.com/howto/howto_js_filter_table.asp)-->
            <script>
                function searchFunction() {
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("product_table");
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
                <h2>Add a Product</h2>
                <br />
                <br />
                <br />
                <form method="post" action="products.php">
                    <label>Product Name:</label>
                    <input type="text" required name="product_name" />
                    <br />
                    <br />
                    <label>Price:</label>
                    <input type="text" required name="product_price" />
                    <br />
                    <br />
                    <label>No of Stock:</label>
                    <input type="text" required name="product_quantity" />
                    <br />
                    <br />
                    <label>Description:</label>
                    <input class="prod_description" type="text" required name="product_description" />
                    <br />
                    <br />
                    <button class="new_record_submit" type="submit" id="new_record_submit" name="submit_product">
                    <p>Submit new Product</p>
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
         
         <table width="100%" class="product_table" id="product_table">
            <thead>
               <tr>
                  <th>ID</th>
                  
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Description</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <?php
$sel_query = "SELECT * FROM products ORDER BY product_id;";
$result = mysqli_query($connectdb, $sel_query);
while ($row = mysqli_fetch_assoc($result))
{ ?>
            <tr>
               <!--Displaying data from the database through echo-->
               <td><?php echo $row["product_id"]; ?></td>
               <td><?php echo $row["name"]; ?></td>
               <td><?php echo $row["price"]; ?></td>
               <td><?php echo $row["quantity"]; ?></td>
               <td><?php echo $row["description"]; ?></td>
               <td>
                <form action="products.php" method="post">
                    <input type="hidden" name="del_id" value="<?php echo $row['product_id']; ?>" />
                    
                    <input class="delete" type="submit" name="delete_row" value="Delete">
                </form>
               </td>
               <td>
                <form action="edit_product.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['product_id']; ?>" />
                    <input type="hidden" name="edit_name" value="<?php echo $row['name']; ?>" />
                    <input type="hidden" name="edit_price" value="<?php echo $row['price']; ?>" />
                    <input type="hidden" name="edit_quantity" value="<?php echo $row['quantity']; ?>" />
                    <input type="hidden" name="edit_description" value="<?php echo $row['description']; ?>" />
                    <!--Button to edit a record-->
                    <input class="edit_record" type="submit" name="edit_row" value="Edit">
                </form>
               </td>
            <tr>
               <?php
} ?>
         </table>         
        <!--//To delete products-->
         <?php
if (isset($_POST['delete_row']))
{
    //Grabs id of input
    $rowPrdId = $_POST['del_id'];
    //Query to delete the row that matches the product_id of the selected row
    $sql = "DELETE FROM products WHERE product_id='$rowPrdId'";
    //Refreshes page to show new records
    if (mysqli_query($connectdb, $sql))
    {
        echo "<div class='alert alert-good'>
            <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
            </span>Product deleted successfully!
          </div>";
        //Error message if product has an active order and is present in another table as a foreign key
        
    }
    else
    {
        echo "<div class='alert alert-bad'>
            <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
            </span>This product is in an active order, please delete the order first
          </div>";
    }
}

?>
      </div>
      
      </div>
      <!--Creating new record php script-->
      <?php
if (isset($_POST['submit_product']))
{
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_description = $_POST['product_description'];

    $new_record = "INSERT INTO products (name, price, quantity, description) VALUES ('$product_name', '$product_price', '$product_quantity', '$product_description')";
    if (mysqli_query($connectdb, $new_record))
    {
        echo
        //By setting onclick to both display=none and location.reload, the webpage reloads and displays the new data and then pops the notification up
        "<div class='alert alert-good'>
                        <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
                        </span>New Product saved successfully!
                      </div>";
    }
    else
    {
        echo "<div class='alert alert-bad'>
                 <span class='closebtn' onclick='location.reload()' onclick='this.parentElement.style.display=`none`;'>&times
                 </span>There was an issue adding this product
               </div>";
    }
}
?>
      </div>
      <!--If a user scrolls down a lot then this button takes them back to the top-->
      <a class="gotopbtn" href="#">Back to Top</a>
   </body>
</html>
