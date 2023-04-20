<?php
// Check user login or not
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
// Logout button
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: login.php');
}
?>