<?php

include 'config.php'; 

$staff_id_edit = @$_POST['edit_id'];
$name_edit = @$_POST['edit_name'];
$username_edit = @$_POST['edit_username'];
$address_edit = @$_POST['edit_address'];
$position_edit = @$_POST['edit_position'];


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit_staff_style.css">
  </head>
  <body>
    <div class="center">
      <h1>Edit Staff</h1>
      <br>
      <form method="post" action="edit_staff.php">
  <input type="hidden" name="staff_id_unique" value="<?php echo $staff_id_edit; ?>" />
    <label>Name:</label>
    <input id="name_input"type="text" name="staff_name" required value="<?php echo $name_edit; ?>" />
    <br />
    <br />
    <label>Username:</label>
    <input type="text" name="staff_username" required value="<?php echo $username_edit; ?>" />
    <br />
    <br />
    <label>Address:</label>
    <input type="text" name="staff_address" required value="<?php echo $address_edit; ?>" />
    <br />
    <br />
    <label>Position:</label>
    <input type="text" name="staff_position" required value="<?php echo $position_edit; ?>" />
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
  header('Location: staff.php');
}

if (isset($_POST['submit_edit'])) {

    //Takes inputs from form
    $staff_id_edit = $_POST['staff_id_unique'];
    $name_edit_one = $_POST['staff_name'];
    $username_edit_one = $_POST['staff_username'];
    $address_edit_one = $_POST['staff_address'];
    $position_edit_one = $_POST['staff_position'];

    $edit_query = "UPDATE staff SET name ='$name_edit_one', username= '$username_edit_one', address='$address_edit_one', position='$position_edit_one' where staff_id='$staff_id_edit'";
     
    if (mysqli_query($connectdb, $edit_query)) {
        echo "<script>window.location.href = 'staff.php';</script>";
        } else {
        echo "<div class='alert alert-bad'>
        <span class='closebtn' onclick='location.href =`staff.php`' onclick='this.parentElement.style.display=`none`;'>&times
        </span>There was an issue
      </div>";
        }
}

?>
