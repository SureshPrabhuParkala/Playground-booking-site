<?php
  include('function.php');
  $func=new dbfunction();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class="header">
		<nav class="nav-bar">
  		<a class="logo" href="">Play for Fun</a>
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

  <main>
    <?php
      $result=$func->index();
      if(mysqli_num_rows($result)>0)
      {
        while($row=$result->fetch_assoc())
        {
		      echo "<div class='sports'>";
				      echo "<div class='card'>";
    			      echo "<a href=sportview.php?id=".$row['sports_id']."><img src='".$row["sports_image"]."'></a>";
      		      echo "<p style='font-family: cursive;'>".$row["sports_name"]."</p>";
    		      echo "</div>";
 			      echo "</div>";
 		      echo "</div>";
        }
      }
    ?>
  </main>

   	<!-- <footer class="footer">
   		<div class="icon-list">
   			<p style="font-family: cursive">Contact Us In</p>
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