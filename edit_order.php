<?php

include 'config.php'; 

$order_id_edit = @$_POST['edit_id'];
$staff_name_edit = @$_POST['edit_staff_name'];
$customer_name_edit = @$_POST['edit_customer_name'];
$date_edit = @$_POST['edit_date'];



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit_order_style.css">
  </head>
  <body>
    <div class="center">
      <h1>Edit Order</h1>
      <br>
      <form method="post" action="edit_order.php">
  <input type="hidden" name="order_id_unique" value="<?php echo $order_id_edit; ?>" />
    <label>Staff Name:</label>
    <input id="name_input"type="text" name="order_staff_name" required value="<?php echo $staff_name_edit; ?>" />
    <br />
    <br />
    <label>Customer Name:</label>
    <input type="text" name="order_customer_name" required value="<?php echo $customer_name_edit; ?>" />
    <br />
    <br />
    <label>Order Date:</label>
    <input type="date" name="order_date" required value="<?php echo $date_edit; ?>" />
    <br />
    <br />
    <div class="buttons">
          <input class="cancel" type="submit" value="Return" name="cancel_edit">
          <input class="submit" type="submit" value="Submit" name="submit_edit">
    </div>
        </div>  
      </form>
    </div>
</body>
</html>
<?php

if (isset($_POST['cancel_edit'])) {
  header('Location: orders.php');
}

if (isset($_POST['submit_edit'])) {

    //Takes inputs from form
    $order_id_edit = $_POST['order_id_unique'];
    $staff_name_edit_one = $_POST['order_staff_name'];
    $customer_name_edit_one = $_POST['order_customer_name'];
    $order_date_edit_one = $_POST['order_date'];

    $edit_query = "UPDATE orders SET staff_id= (SELECT staff_id FROM staff WHERE name = '$staff_name_edit_one'), customer_id=(SELECT customer_id FROM customers WHERE name = '$customer_name_edit_one'), order_date='$order_date_edit_one' where order_id='$order_id_edit'";
     
    if (mysqli_query($connectdb, $edit_query)) {
        echo "<script>window.location.href = 'orders.php';</script>";
        } else {
        echo "<div class='alert alert-bad'>
        <span class='closebtn' onclick='location.href =`orders.php`' onclick='this.parentElement.style.display=`none`;'>&times
        </span>There was an issue
      </div>";
        }
}

?>
