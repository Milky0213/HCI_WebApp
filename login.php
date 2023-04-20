<?php
include 'config.php';

// Check user login or not
if(isset($_SESSION['username'])){
  header('Location: Index.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Qmire Management System | Login</title>
    <link rel="stylesheet" href="login_style.css">
    <link rel="icon" href="./images/QmireLogo.png">
  </head>
  <body>
    <div class="welcomeone">
    <h1>Please login to</h1>
    </div>
    <div class="welcometwo">
    <h1>Qmire Management System</h1>
    </div>
    <div class="center">
      <h1>Log In</h1>
      <form action="login.php" method="post">
        <div class="txt_field">
          <input type="text" id="username" name="username" required>
          <span></span>
          <label>E.g. JohnSmith90</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password" name="password" required>
          <span></span>
          <label>E.g. ILoveCS123</label>
        </div>
        <div class="submit">
          <input type="submit" value="Login" name="but_submit">
        </div>
      </form>
    </div>
  <?php
    if(isset($_POST['but_submit'])){
    //Retreive inputs from login page
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connectdb, $username);
    $password = mysqli_real_escape_string($connectdb, $password);

    //Search databse for instance of username and password
    //Inner join for more security
    $sql = "SELECT username, password FROM staff INNER JOIN password ON staff.staff_id = password.staff_id WHERE username = '".$username."' AND password = '".$password."'";

    $result = mysqli_query($connectdb, $sql);
    //Checking if the inputted login & password match the database
    $check = mysqli_fetch_array($result);
    if (@$check['username'] == $username && @$check['password'] == $password ){
      $_SESSION['username'] = $username;
      header("Location: Index.php");
    } else {
      echo '<script language="javascript">';
      echo 'alert("Failed to Login, you have 2 more attempts")';
      echo '</script>';
    }  
  }
  ?>
  </body>
</html>


