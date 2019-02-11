<?php
	include('function.php');
	$func=new dbfunction();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin View</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  			<a href="" class="logo">Play for Fun</a>
  			<a class="nav_bar" href="logout.php">Logout</a>
        	<a class="nav_bar" href="addsport.php">Add Sport</a>
        	<a class="nav_bar" href="addvenue.php">Add Venue</a>	

		</nav>
	</header>

	<main>
		<h2 class="headings">Booking Details</h2>
		<?php
			$resultbooked=$func->bookedtable();
			$resultsports=$func->index();
			$resultusers=$func->usertable();
			$resultvenue=$func->venuetable();
			$resultadmin=$func->admintable();
			echo "<table class='bookedtableview'>
					<tr>
						<th>User Id</th>
						<th>User Name</th>
						<th>Sports id</th>
						<th>Venue Id</th>
						<th>Date</th>
						<th>Time</th>
						<th>Team A</th>
						<th>Team B</th>
					</tr>";
			  	while($bookrow=$resultbooked->fetch_assoc())
			  	{
			  		echo "<tr>";
			  			echo "<td>".$bookrow['user_id']."</td>";
			  			echo "<td>".$bookrow['user_name']."</td>";
			  			echo "<td>".$bookrow['sports_id']."</td>";
			  			echo "<td>".$bookrow['venue_id']."</td>";
			  			echo "<td>".$bookrow['datee']."</td>";
			  			echo "<td>".$bookrow['timee']."</td>";
			  			echo "<td>".$bookrow['team_a']."</td>";
			  			echo "<td>".$bookrow['team_b']."</td>";
			  		echo "</tr>";
			  	}
				echo "</table>";

				echo "<h2 class='headings'>Sports Details</h2>";
				echo "<table class='sportstableview'>
					<tr>
						<th>Sports id</th>
						<th>Sports Name</th>
					</tr>";
			  	while($sportsrow=$resultsports->fetch_assoc())
			  	{
			  		echo "<tr>";
			  			echo "<td>".$sportsrow['sports_id']."</td>";
			  			echo "<td>".$sportsrow['sports_name']."</td>";
			  		echo "</tr>";
			  	}
				echo "</table>";

				echo "<h2 class='headings'>Venue Details</h2>";
				echo "<table class='venuetableview'>
					<tr>
						<th>Venue Id</th>
						<th>Place</th>
						<th>Venue Name</th>
						<th>Sports Id</th>
						<th>Price</th>
						<th>Maximum Players</th>
					</tr>";
			  	while($venuerow=$resultvenue->fetch_assoc())
			  	{
			  		echo "<tr>";
			  			echo "<td>".$venuerow['venue_id']."</td>";
			  			echo "<td>".$venuerow['place']."</td>";
			  			echo "<td>".$venuerow['venue_name']."</td>";
			  			echo "<td>".$venuerow['sports_id']."</td>";
			  			echo "<td>".$venuerow['price']."</td>";
			  			echo "<td>".$venuerow['maximum_players']."</td>";
			  		echo "</tr>";
			  	}
				echo "</table>";

				echo "<h2 class='headings'>User Details</h2>";
				echo "<table class='venuetableview'>
					<tr>
						<th>User Id</th>
						<th>User Name</th>
						<th>Email Id</th>
						<th>Phone Number</th>
					</tr>";
			  	while($userrow=$resultusers->fetch_assoc())
			  	{
			  		echo "<tr>";
			  			echo "<td>".$userrow['user_id']."</td>";
			  			echo "<td>".$userrow['user_name']."</td>";
			  			echo "<td>".$userrow['email']."</td>";
			  			echo "<td>".$userrow['phone_number']."</td>";
			  		echo "</tr>";
			  	}
				echo "</table>";
		?>
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