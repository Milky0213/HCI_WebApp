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
      <link rel="stylesheet" href="index_style.css">
   </head>
   <body>
        <!--Cleaner than placing navbar on every page-->
         <?php include 'config_navbar.php'; ?>       
      <main>
        
        <!--Div for positioning title-->
         <div class="namedef">
            <h1 class="name">Welcome!</h1>
         </div>
      </main>
      <!--If a user scrolls down a lot then this button takes them back to the top-->
      <a class="gotopbtn" href="#">Back to Top</a>
   </body>
</html>
