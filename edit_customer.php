<?php

include 'config.php'; 

$customer_id_edit = @$_POST['edit_id'];
$name_edit = @$_POST['edit_name'];
$address_edit = @$_POST['edit_address'];
$phone_edit = @$_POST['edit_phone'];
$email_edit = @$_POST['edit_email'];


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit_customer_style.css">
  </head>
  <body>
    <div class="center">
      <h1>Edit Customer</h1>
      <br>
      <form method="post" action="edit_customer.php">
  <input type="hidden" name="customer_id_unique" value="<?php echo $customer_id_edit; ?>" />
    <label>Name:</label>
    <input id="name_input"type="text" name="customer_name" required value="<?php echo $name_edit; ?>" />
    <br />
    <br />
    <label>Address:</label>
    <input type="text" name="customer_address" required value="<?php echo $address_edit; ?>" />
    <br />
    <br />
    <label>Phone number:</label>
    <input type="text" name="customer_phone" required value="<?php echo $phone_edit; ?>" />
    <br />
    <br />
    <label>Email:</label>
    <input type="email" name="customer_email" required value="<?php echo $email_edit; ?>" />
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
  header('Location: customers.php');
}

if (isset($_POST['submit_edit'])) {

    //Takes inputs from form
    $customer_id_edit = $_POST['customer_id_unique'];
    $name_edit_one = $_POST['customer_name'];
    $address_edit_one = $_POST['customer_address'];
    $phone_edit_one = $_POST['customer_phone'];
    $email_edit_one = $_POST['customer_email'];

    $edit_query = "UPDATE customers SET name ='$name_edit_one', address= '$address_edit_one', phone='$phone_edit_one', email='$email_edit_one' where customer_id='$customer_id_edit'";
     
    if (mysqli_query($connectdb, $edit_query)) {
        echo "<script>window.location.href = 'customers.php';</script>";
        } else {
        echo "<div class='alert alert-bad'>
        <span class='closebtn' onclick='location.href =`customers.php`' onclick='this.parentElement.style.display=`none`;'>&times
        </span>There was an issue
      </div>";
        }
}

?>
