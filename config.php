<?php
//If I need to change password or dbname later
session_start();
$dbusername = 'root';
$dbpsw = '';
$dbname = 'qmire_system';

$connectdb = mysqli_connect('localhost', $dbusername, $dbpsw, $dbname);
//If connection doesn't work
if ($connectdb === false) {
    die("Connection failed: " . mysqli_connect_error());
}
?>