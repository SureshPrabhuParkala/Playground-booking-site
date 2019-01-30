<?php
	include('function.php');
	$func=new dbfunction();
    $con=$func->connection();
    $id=$_GET['id'];
    if (isset($_POST['submitvenue'])) 
    {
    	$venuename=$_POST['venuename'];
    	$func->venueview($venuename, $con);
    }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Sport</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<p>Play for Fun</p>
  			<a href="signup.php">SignUp</a>
  			<a href="login.php">Login</a>	
		</nav>
	</header>

	 <?php
	 	$q="SELECT * FROM sports WHERE sports_id='$id'";
	 	$result=mysqli_query($con,$q);
        $row=$result->fetch_assoc();
        echo "<main><div style='height:215px;'>
        <div class='left'><img class='detail-img' src='".$row['sports_image']."' alt='Cricket'></div>
        <div class='right'><p>".$row['sports_description']."</p></div></div>";
	 ?>

	 <section>
		<div class="venue-selector">
			<form action="" method="post" class="venue-dropdown" style="padding-left: 5%;">
				<?php
  					$q1="SELECT DISTINCT place FROM venue WHERE sports_id='$id';";
  					$result=mysqli_query($con,$q1);
  					if (mysqli_num_rows($result)>0)
  					{
  						echo "<select id='venue' name='venueplace' style='width: 100%;'>";
  						while($row=$result->fetch_assoc())
  						{
    						echo "<option value='".$row['place']."' class='venue-place-option-value'>".$row['place']."</option>";
    					}
  					}
  					echo "</select>";
  				?>

  				
  				<?php
  					$q2="SELECT venue_name FROM  venue WHERE sports_id='$id';";
  					$result=mysqli_query($con,$q2);
  					if(mysqli_num_rows($result)>0)
  					{
  						echo "<select id='venue' name='venuename' style='margin-top: 5%;width: 100%;' onchange='check(this);'>";
  						while($row=$result->fetch_assoc())
  						{ 
  							
    						echo "<option value='".$row['venue_name']."' class='venue-place-option-value'>".$row['venue_name']."</option>";
    					}
  				    }
  				    echo "<input type='submit' class='submit' name='submitvenue'></a>";
  				?>
			</form>
		</div>
	</section>

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