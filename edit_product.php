<?php

include 'config.php'; 

$product_id_edit = @$_POST['edit_id'];
$name_edit = @$_POST['edit_name'];
$price_edit = @$_POST['edit_price'];
$quantity_edit = @$_POST['edit_quantity'];
$description_edit = @$_POST['edit_description'];


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit_product_style.css">
  </head>
  <body>
    <div class="center">
      <h1>Edit Product</h1>
      <br>
      <form method="post" action="edit_product.php">
  <input type="hidden" name="product_id_unique" value="<?php echo $product_id_edit; ?>" />
    <label>Name:</label>
    <input id="name_input"type="text" name="product_name" required value="<?php echo $name_edit; ?>" />
    <br />
    <br />
    <label>Price:</label>
    <input type="text" name="product_price" required value="<?php echo $price_edit; ?>" />
    <br />
    <br />
    <label>Quantity:</label>
    <input type="text" name="product_quantity" required value="<?php echo $quantity_edit; ?>" />
    <br />
    <br />
    <label>Description:</label>
    <input type="text" name="product_description" required value="<?php echo $description_edit; ?>" style="width: 70%;" />
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
  header('Location: products.php');
}

if (isset($_POST['submit_edit'])) {

    //Takes inputs from form
    $product_id_edit = $_POST['product_id_unique'];
    $name_edit_one = $_POST['product_name'];
    $price_edit_one = $_POST['product_price'];
    $quantity_edit_one = $_POST['product_quantity'];
    $description_edit_one = $_POST['product_description'];

    $edit_query = "UPDATE products SET name ='$name_edit_one', price= '$price_edit_one', quantity='$quantity_edit_one', description='$description_edit_one' where product_id='$product_id_edit'";
     
    if (mysqli_query($connectdb, $edit_query)) {
        echo "<script>window.location.href = 'products.php';</script>";
        } else {
        echo "<div class='alert alert-bad'>
        <span class='closebtn' onclick='location.href =`products.php`' onclick='this.parentElement.style.display=`none`;'>&times
        </span>There was an issue
      </div>";
        }
}

?>
