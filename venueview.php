<?php
	include('function.php');
	$func=new dbfunction();
    $con=$func->connection();
    $id=$_GET['id'];
    $pid=$_GET['pid'];
    session_start();
    if(isset($_POST['book_now']))
    {
    	if(isset($_SESSION['login_user']))
    	{
    		$team=$_POST['team'];
    		$date=$_POST['date'];
    		$session=$_POST['session'];
    		$number=$_POST['no_of_person'];
    		$venueid=$id;
    		$sportsid=$pid;

    		$func->booking($_SESSION['login_id'], $_SESSION['login_user'], $sportsid, $venueid, $date, $team, $session, $team, $number, $con);
    	}
    	else
    		header('location: login.php');
    }
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
  			<a class="logo" href="sportview.php?id=<?php echo $pid;?>">Play for Fun</p>
  			<?php
  				if(isset($_SESSION['login_user']))
  				{
  					echo "<a class='nav_bar' href='logout.php'>Logout</a>
          				  <a class='nav_bar'>".$_SESSION['login_user']."</a>";
          		}
          		else
          		{
  					echo "<a class='nav_bar' href='signup.php'>SignUp</a>
  						  <a class='nav_bar' href='login.php'>Login</a>";	
          		}
          	?>
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
				  <p class='desc'>Amount : <b style='color: red;'>".$row['price']."/- Per Head</b></p>";



			echo "<div class='booking'>";
  				echo "<form action='' class='booking-form' method='post'>";
    				echo "<p>Choose Your Team:</p>";
    					echo "<div class='radio-button'>";
    						echo "<input type='radio' value='TeamA' name='team' required> Team A(11)";
							echo "<input type='radio' value='TeamB'  name='team' style='margin-left: 27%;' required> Team B(11)";
						echo "</div>";
						echo "<div>";
							echo "<p style='margin-left: 5%'>Date: <input type='date' name='date' required>";
					  			echo "<b style='margin-left: 4%;'>Session: </b><select id='session' name='session' required>";
    								echo "<option value='Morning' class='session-options'>Morning (7am to 10am)</option>";
    								echo "<option value='Afternoon' class='session-options'>Afternoon (11am to 2pm)</option>";
    								echo "<option value='Evening' class='session-options'>Evening (3pm to 6pm)</option>";
  								echo "</select>";
  							echo "</p>";
						echo "</div>";
						echo "<div>";
							echo "<center>Amount:<b style='margin-left: 2%;color: red;'>".$row['price']."/-</b></center>";
						echo "</div>";
						echo "<div>";
							echo "<p style='margin-top: 3%;''><center>Number of persons: <input type='Number' min='0' class='no-of-person' name='no_of_person' required></center></p>";
						echo "</div>";
    					echo "<input type='submit' class='book-now' name='book_now' style='background-color: red;font-weight: bold;margin-top: 3%;'>";
  				echo "</form>";
			echo "</div>";
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