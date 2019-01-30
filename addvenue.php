<?php
  include('function.php');
  $func=new dbfunction();
  $con=$func->connection();

  if (isset($_POST['addvenue'])) 
  {
      $placename=$_POST['placename'];
      $venuename=$_POST['venuename'];
      if (isset($_POST['detail']))
        $details=$_POST['detail'];
      $price=$_POST['price'];
      $maxplayers=$_POST['maxplayers'];
      $sport=$_POST['sport'];
      if (isset($_FILES['file']['name']))
        $filename=$_FILES['file']['name'];


      if($con)
      {
        $func->uploadvenue($placename, $venuename, $details, $price, $maxplayers, $sport, $filename, $con);
      }
  }
?>



<!DOCTYPE html>
<html>
<head>
	<title>Add Venue</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<p>Play for Fun</p>
  			<a href="index.php">Logout</a>
        	<a href="addsport.php">Add Sport</a>	
		</nav>
	</header>

	<main>
		<div class="add-venue">
			<p style="font-family: cursive;color: white;font-size: 40px;margin-top: 3%;margin-left: 10%;">Add Venue</p>
      		<form class="add-venue-form" method="post" action="addvenue.php" enctype="multipart/form-data">
        		<input type="text" placeholder="Enter Place Name" id="place-name" name="placename" required autocomplete="off">
            <input type="text" placeholder="Enter Venue Name" id="venue-name" name="venuename" required autocomplete="off">
        		<textarea placeholder="Enter the Details" required name="detail"></textarea>
        		<input type="text" placeholder="Enter the Price Per Person" id="price" name="price" required autocomplete="off">
        		<input type="number" placeholder="Maximum Players" id="maxplayers" name="maxplayers" min="1" required>

              <?php
                $q="SELECT sports_name FROM sports";
                $result=mysqli_query($con,$q);
                if(mysqli_num_rows($result)>0)
                {
                  echo "<select id='sports-list' name='sport'>";
                  while($row=$result->fetch_assoc())
                  {
                    echo "<option value='".$row['sports_name']."' class='venue-place-option-value'>".$row['sports_name']."</option>";
                  }
                  echo "</select>";
               }
               ?>
            
            <center><input type="file" name="file" style="color: white;" required></center>
        		<div>
              		<button type="submit" id="add-sport-button" name="addvenue" style="float: left;margin-left: 5%;">Add</button>
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