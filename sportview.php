<?php
	include('function.php');
	$func=new dbfunction();
    $id=$_GET['id'];
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
  			<a class="logo" href="index.php">Play for Fun</a>
  			<?php
  				session_start();
  				if(isset($_SESSION['login_user']))
        		{
        			echo "<a class='nav_bar' href='logout.php'>Logout</a>
          				  <a class='nav_bar' href='userhistory.php'>".$_SESSION['login_user']."</a>";
          		}
          		else
          		{
  					echo "<a class='nav_bar' href='signup.php'>SignUp</a>
  						  <a class='nav_bar' href='login.php'>Login</a>";	
  				}
  			?>
		</nav>
	</header>

	 <?php
	 	$result=$func->Sports($id);
        $row=$result->fetch_assoc();
        echo "<main><div style='height:215px;'>
        <div class='left'><img class='detail-img' src='".$row['sports_image']."' alt='Cricket'></div>
        <div class='right'><p>".$row['sports_description']."</p></div></div>";
	 ?>

	 <section>
		<div class="venue-selector">
			<form action="" method="post" class="venue-dropdown" style="padding-left: 5%;">
				<?php
  					$result=$func->placedropdown($id);
  					if (mysqli_num_rows($result)>0)
  					{
  						echo "<select id='venue' name='venueplace' style='width: 100%;' onchange='javascript:value()'><option class='venue-place-option-value' hidden selected>Select The Place</option>";
  						while($row=$result->fetch_assoc())
  						{
    						echo "<option value='".$row['place']."' class='venue-place-option-value'>".$row['place']."</option>";
    					}
  					}
  					echo "</select>";

  					
  				?>
				<input type='submit' class='submit' name='submitvenue'></a>
			</form>
		</div>

		<?php
					if (isset($_POST['submitvenue'])) {
						$venueplace=$_POST['venueplace'];
						$result=$func->list_of_venue($venueplace, $id);
						while($row=$result->fetch_assoc())
						{
							echo "<a href='venueview.php?id=".$row['venue_id']."&pid=".$id."' style='text-decoration: none;'><p class='list_of_venue'>".$row['venue_name'].",<b style='color: red;'> ".$row['price']."/-</b> Per Person</p></a>";
						}
					}
				?>
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