<?php
	include('function.php');
	$func=new dbfunction();
	$num=$_GET['players'];
	$vid=$_GET['vid'];
	$result=$func->calc($vid);
	$row=$result->fetch_assoc();
	$price=$row['price'];
	$amt=$price*$num;
	echo $amt;
?>