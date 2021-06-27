<!-- The main page-->
<!DOCTYPE html>
<html>
<head>
    <title>Home </title>
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<div w3-include-html="header.html"></div>

<body >
<div id="wrapper">
    <div>
    	<?php
         session_start();
        if(isset($_SESSION['userinfo'])){
            require "Header2.php";
        }
        else{
             require "Header.php";
        } ?>
      <div>
      		  
      </div>
   </div>
</div> 
</body>
</html>
