<?php
  include('function.php');
  $func=new dbfunction();
  if(isset($_POST['userlogin']))
  {
      $name=$_POST['username'];
      $password=$_POST['password'];
      $func->loginValidation($name, $password);
  }

  if(isset($_POST['adminlogin']))
  {
    $name=$_POST['username'];
    $password=$_POST['password'];
    $func->adminloginValidation($name, $password);
  }

  if(isset($_POSt['cancel']))
  {
    header("location: index.php");
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>

<body>
  <header class="header">
    <nav class="nav-bar">
      <a class="logo" href="index.php">Play for Fun</a>
      <a class="nav_bar" href="signup.php">SignUp</a>
    </nav>
  </header>

  <main  class="back-img">
    <div class="login-box">
      <img class="user-img" src="images\user.png">
      <form class="login" method="post" action="" autocomplete="off">
        <input type="text" placeholder="Enter Username" id="Username" name="username" required>
        <input type="password" placeholder="Enter Password" id="Password" name="password" required>
    	  <button type="submit" id="login-as-admin" name="adminlogin" style="float: left;width: 45%;">Login as Admin</button>
        <button type="login" id="login-as-user" name="userlogin" style="float: right;width: 45%;">Login as User</button>
        <div>
    	    <a href="index.php"><button type="button" id="cancel-button" name="cancel">Cancel</button></a>
        </div>
        <a href="#" class="forgot-password" style="margin-top: 50%"><center>Forgot Password?</center></a>
	    </form>
    </div>
  </main> 

  <footer class="footer" style="margin-top: 0%">
    <div class="icon-list">
      <p style="font-family: cursive">Contact Us In</p>
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