<?php
  include('function.php');
  $func=new dbfunction();
  if(isset($_POST['add'])) 
  {
    $filename=$_FILES["file"]["name"];
    $name=$_POST['name'];
    $details=$_POST['details'];
    $func->uploadsport($name, $details, $filename);
  }
?>




<!DOCTYPE html>
<html>
<head>
	<title>Add Sport</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<a class="logo">Play for Fun</a>
  			<a class="nav_bar" href="index.php">Logout</a>
        <a class="nav_bar" href="addvenue.php">Add Venue</a>	
		</nav>
	</header>

	<main>
		<div class="add-sport">
      <p style="font-family: cursive;color: white;font-size: 40px;margin-top: 3%;margin-left: 10%;">Add sport</p>
      		<form class="add-sport-form" method="post" action="" enctype="multipart/form-data">
        		<input type="text" placeholder="Enter Sport Name" id="sport-name" name="name" required autocomplete="off">
        		<textarea placeholder="Enter the Details" name="details" required></textarea>
            <center><input type="file" name="file" style="color: white;" required></center>
        		<div>
              <button type="submit" id="add-sport-button" name="add" style="float: left;margin-left: 5%;">Add</button>
              <button type="Cancel" id="cancel-add-sport" style="float: right;margin-right: 5%;">Cancel</button>
        		</div>
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