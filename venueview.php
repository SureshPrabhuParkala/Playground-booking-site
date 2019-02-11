<?php
	include('function.php');
	$func=new dbfunction();
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

    		$func->Booking($_SESSION['login_id'], $_SESSION['login_user'], $sportsid, $venueid, $date, $session, $team, $number);
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

	<main class="stadium-details">
		<?php
			$result=$func->venue($id);
			$row=$result->fetch_assoc();
			echo "<main><div style='height:215px;'>
        	<div class='left'><img class='detail-img' src='".$row['venue_image']."' alt='".$row['venue_name']."'></div>
        	<div class='right'><p class='desc'>".$row['venue_description']."</p></div></div>";
        	$player=$row['maximum_players']/2;
			echo "<p class='desc' style='margin-top: 5%;font-weight: bold;'>Maximum Players:</p>
				  <p class='desc'>Team A : ".$player."</p>
				  <p class='desc'>Team B : ".$player."</p>
				  <p class='desc'>Amount : <b style='color: red;'>".$row['price']."/- Per Head</b></p>";



			echo "<div class='booking'>
  					<form action='' class='booking-form' method='post'>
    					<p>Choose Your Team:</p>
    						<div class='radio-button'>
    							<input type='radio' value='TeamA' name='team' required> Team A
								<input type='radio' value='TeamB'  name='team' style='margin-left: 45%;' required> Team B
							</div>";

						echo "<div class='remaining'>";
							echo "Remaining in Team A: <span style='color: red;' id='remainA'>".$player."</span>";
							echo "<span style='margin-left: 14%;'>Remaining in Team B: <span style='color: red;' id='remainB'>".$player."</span></span>";
						echo "</div>";

						echo "<div>
								<p style='margin-left: 5%'>Date: <input type='date' name='date' required id='date'>
					  				<b style='margin-left: 12%;'>Session: </b><select id='session' name='session' required onchange='remainingseatA(this.value); remainingseatB(this.value);'>
					  					<option class='session-options' hidden selected>Select One</option>
    									<option value='Morning(7am to 10am)' class='session-options'>Morning (7am to 10am)</option>
    									<option value='Afternoon(11am to 2pm)' class='session-options'>Afternoon (11am to 2pm)</option>
    									<option value='Evening(3pm to 6pm)' class='session-options'>Evening (3pm to 6pm)</option>
  									</select>
  								</p>
							</div>";
						echo "<div>
								<p style='margin-top: 1%;''><center>Number of persons: <input type='Number' min='1' class='no-of-person' name='no_of_person' required value='1' onchange='calamount(this.value)' id='no_of_players'></center></p>
							</div>";
						echo "<div>
								<center><p style='margin-top: 3%;'>Amount:<span id='price' style='color: red;margin-left: -3%;'>".$row['price']."/-</span></p></center>
							</div>";
    					echo "<input type='submit' value='Book' class='book-now' name='book_now' style='background-color: red;font-weight: bold;margin-top: 3%;'>";
  				echo "</form>";
			echo "</div>";
		?>

		<script>
			function calamount(str)
			{ 
  				if (window.XMLHttpRequest)
    				xmlhttp=new XMLHttpRequest();

  				xmlhttp.onreadystatechange=function()
  				{
    				if (this.readyState==4 && this.status==200)
      					document.getElementById("price").innerHTML=this.responseText+"/-";
  				}
  				xmlhttp.open("GET","getamount.php?players="+str+"&&vid=<?php echo $id?>",true);
  				xmlhttp.send();
			}

			function remainingseatA(time)
			{	
				var date=document.getElementById("date").value;
				if (window.XMLHttpRequest)
    				xmlhttp=new XMLHttpRequest();

  				xmlhttp.onreadystatechange=function()
  				{
    				if (this.readyState==4 && this.status==200)
      					document.getElementById("remainA").innerHTML=this.responseText;
  				}
  				xmlhttp.open("GET","getremainingseatA.php?date="+date+"&&time="+time+"&&vid='<?php echo $id ?>'",true);
  				xmlhttp.send();
			}

			function remainingseatB(time)
			{	
				var date=document.getElementById("date").value;
				if (window.XMLHttpRequest)
    				xmlhttp=new XMLHttpRequest();

  				xmlhttp.onreadystatechange=function()
  				{
    				if (this.readyState==4 && this.status==200)
      					document.getElementById("remainB").innerHTML=this.responseText;
  				}
  				xmlhttp.open("GET","getremainingseatB.php?date="+date+"&&time="+time+"&&vid='<?php echo $id ?>'",true);
  				xmlhttp.send();
			}
		</script>

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