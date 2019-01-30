<?php
  include('function.php');
  $func=new dbfunction();
  if(isset($_POST['submit'])){
      $name=$_POST['Name'];
      $email=$_POST['Email'];
      $phone=$_POST['Phone'];
    if (isset($_POST['Password'])) 
    { 
      $password=$_POST['Password'];
    }

    $con=$func->connection();
    if($con)
    {
      $func->UserRegister($name, $email, $password, $phone, $con);
    }
  }

  if(isset($_POST['register-cancel']))
  {
    header("Location: index.php");
  }
?>



<!DOCTYPE html>
<html>
<head>
	<title>SignUp</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<p>Play for Fun</p>
  			<a href="login.php">Login</a>	
		</nav>
	</header>

	<main>
  
    	<div class="register-box">

      	<img class="register-img" src="images\user.png">
      		<form class="register" method="post" action="" autocomplete="off">

        		<input type="text" placeholder="Enter Username" id="Username" name="Name" required style="border-color: black;margin-top: 10%;">
        		<input type="Email" placeholder="Enter Email" id="email" name="Email" required style="border-color: black;">
        		<input type="phone" placeholder="Enter Contact" id="phone" name="Phone" required style="border-color: black;">
        		<input type="Password" placeholder="Enter Password" id="Password" name="Password" required style="border-color: black;">

    	 		  <button type="submit" id="register" name="submit" style="float: left;">Register</button>
        		<button type="Cancel" id="register-cancel" onclick="index.php;" style="float: right;">Cancel</button>

        		<a href="login.html" class="already-registered"><center>Already Rgistered? Login</center></a>

	    	</form>

    	</div>

  	</main>

	<footer class="footer">
 		<div class="icon-list">
 			<p style="font-family: cursive;">Contact Us In</p>
 			<a href="#"><img src="images\facebook.png" class="icon"></a>
			<a href="#"><img src="images\twitter1.png" class="icon"></a>
			<a href="#"><img src="images\linkedin.png" class="icon"></a>
			<a href="#"><img src="images\google.png" class="icon"></a>
		</div>
		<div class="copyright">
 			<p><center>Copyright © 2019 Play for Fun.All rights reserved</center></p>
 		</div>
 	</footer>
</body>
</html>