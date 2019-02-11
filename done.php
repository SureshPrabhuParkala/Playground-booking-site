<?php
	include('function.php');
	$func=new dbfunction();
	$team=$_GET['t'];
	$player=$_GET['num'];
	$sportid=$_GET['sport'];
	$venueid=$_GET['venue'];
	$time=$_GET['time'];
	$date=$_GET['date'];
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
				$result=$func->FetchSportName($sportid);
				$row=$result->fetch_assoc();
				$result1=$func->FetchVenueTable($venueid);
				$row1=$result1->fetch_assoc();
				$price=$row1['price'];
				$amount=$price*$player;
				echo "<p class='done-display'>Name : ".$_SESSION['login_user']."</p>
					  <p class='done-display'>User_Id : ".$_SESSION['login_id']."</p>
					  <p class='done-display'>Sport : ".$row['sports_name']."</p>
					  <p class='done-display'>Venue : ".$row1['venue_name']."</p>
					  <p class='done-display'>Place : ".$row1['place']."</p>
					  <p class='done-display'>Time : ".$time."</p>
					  <p class='done-display'>Date : ".$date."</p>
					  <p class='done-display'>Team : ".$team."</p>
					  <p class='done-display'>No.Of Players : ".$player."</p>
					  <p class='done-display'>Amount : ".$amount."/-</p>";
			?>
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