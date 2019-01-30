<?php
	include('function.php');
	$func=new dbfunction();
    $con=$func->connection();
    $id=$_GET['id'];
?>


<!DOCTYPE html>
<html>
<head>
	<title>Venue</title>
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

	<main class="stadium-details">
		<?php
			$q="SELECT * FROM venue WHERE venue_id='$id'";
			$result=mysqli_query($con,$q);
			$row=$result->fetch_assoc();
			echo "<main><div style='height:215px;'>
        	<div class='left'><img class='detail-img' src='".$row['venue_image']."' alt='".$row['venue_name']."'></div>
        	<div class='right'><p class='desc'>".$row['venue_description']."</p></div></div>";
        	$player=$row['maximum_players']/2;
			echo "<p class='desc' style='margin-top: 5%;font-weight: bold;'>Maximum Players:</p>
				  <p class='desc'>Team A : ".$player."</p>
				  <p class='desc'>Team B : ".$player."</p>
				  <p class='desc'>Amount : <b style='color: red;'>".$row['price']."</b></p>";	
		?>

		<div class="booking">
  			<form action="#" class="booking-form" method="get">
    			<p>Choose Your Team:</p>
    			<div class="radio-button">
    				<input type="radio" value="TeamA" name="Team"> Team A(11)
					<input type="radio" value="TeamB"  name="Team" style="margin-left: 25%;"> Team B(11)
				</div>
				<div>
					<p style="margin-left: 5%">Date: <input type="date" name="date">
					  <b style="margin-left: 3%;">Session: </b><select id="session">
    								<option value="morning" class="session-options">Morning (7am to 10am)</option>
    								<option value="afternoon" class="session-options">Afternoon (11am to 2pm)</option>
    								<option value="evening" class="session-options">Evening (3pm to 6pm)</option>
  								</select>
  					</p>
				</div>
				<div>
					<center>Amount:<b style="margin-left: 2%;color: red;">Free</b></center>
				</div>
				<div>
					<p style="margin-top: 3%;"><center>Number of persons: <input type="Number" name="1" min="0" class="no-of-person"></center></p>
				</div>
    				<input type="submit" class="book-now" value="Book Now" style="background-color: red;font-weight: bold;margin-top: 3%;">
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