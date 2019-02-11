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
  			<a class="nav_bar" href="index.php">Logout</a>
        	<a class="nav_bar" href="addsport.php">Add Sport</a>
        	<a class="nav_bar" href="addvenue.php">Add Venue</a>	

		</nav>
	</header>

	<?php
		$resultbooked=$func->bookedtable();
		$resultsports=$func->index();
		$resultusers=$func->usertable();
		$resultvenue=$func->venuetable();
		echo "<table class='tableview'>
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
	?>

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