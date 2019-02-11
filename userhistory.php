<?php
	include('function.php');
	$func=new dbfunction();
?>
<!DOCTYPE html>
<html>
<head>
	<title>User History</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<a class="logo" href="index.php">Play for Fun</a>
  			<?php
  				session_start();
  				echo "<a class='nav_bar' href='logout.php'>Logout</a>
           			  <a class='nav_bar'>".$_SESSION['login_user']."</a>";
  			?>	
		</nav>
	</header>

	<main>
			<?php
				$result=$func->BookingDisplay($_SESSION['login_user']);
				while($row=$result->fetch_assoc())
				{
					echo "<div class='outer-history-card'>
						  <div class='history-card'>
					  	  <div><p class='history-display'>User Id : ".$row['user_id']."</p>";
					$result2=$func->FetchVenueTable($row['venue_id']);
			    	$row2=$result2->fetch_assoc();
			   		echo "<p class='history-display'>Venue Name : ".$row2['venue_name']."</p></div>";
			    	$result1=$func->FetchSportName($row['sports_id']);
					$row1=$result1->fetch_assoc();
					echo "<p class='history-display'>Sports Name : ".$row1['sports_name']."</p>
					  	  <p class='history-display'>Date : ".$row['datee']."</p>
					      <p class='history-display'>time : ".$row['timee']."</p>
					      <p class='history-display'>Team A : ".$row['team_a']."</p>
					      <p class='history-display'>Team B : ".$row['team_b']."</p>";
					$price=$row2['price'];
					$amt1=$price*$row['team_a'];
					$amt2=$price*$row['team_b'];
					$amount=$amt1+$amt2;
					echo "<p class='history-display'>Amount : ".$amount;
					echo "</div></div>";
				}
			?>
	</main>

	<!-- <footer class="footer">
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
 	</footer> -->
</body>
</html>