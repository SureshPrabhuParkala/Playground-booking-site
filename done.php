<?php
	include('function.php');
	$func=new dbfunction();
	$team=$_GET['$t'];
	$player=$_GET['$num'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Done</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<a class="logo" href="index.php">Play for Fun</a>
  			<?php
  				session_start();
  				echo "<a class='nav_bar' href='logout.php'>Logout</a>
           			  <a class='nav_bar' href='userhistory.php'>".$_SESSION['login_user']."</a>";
  			?>	
		</nav>
	</header>

	<main>
		<div class="done-card">
			<p class="done-text">Done</p>
			<?php
				$result=$func->BookingDisplay($_SESSION['login_user']);
				$row=$result->fetch_assoc();
				$result1=$func->FetchSportName($row['sports_id']);
				$row1=$result1->fetch_assoc();
				$result2=$func->FetchVenueTable($row['venue_id']);
				$row2=$result2->fetch_assoc();
				$price=$row2['price'];
				$amount=$price*$player;
				echo "<p class='done-display'>Name : ".$row['user_name']."</p>
					  <p class='done-display'>User_Id : ".$row['user_id']."</p>
					  <p class='done-display'>Sport : ".$row1['sports_name']."</p>
					  <p class='done-display'>Venue : ".$row2['venue_name']."</p>
					  <p class='done-display'>Place : ".$row2['place']."</p>
					  <p class='done-display'>Time : ".$row['timee']."</p>
					  <p class='done-display'>Team : ".$team."</p>
					  <p class='done-display'>No.Of Players : ".$player."</p>
					  <p class='done-display'>Amount : ".$amount."/-</p>";
			?>
		</div>
		<p class="enjoy">Enjoy The Day</p>
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