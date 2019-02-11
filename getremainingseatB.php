<?php
	include('function.php');
	$func=new dbfunction();
    $date=$_GET['date'];
    $time=$_GET['time'];
    $vid=$_GET['vid'];
    $result=$func->getremainingseatB($date, $time, $vid);
    $res=$func->getmaxplayers($vid);
    $row=$res->fetch_assoc();
    $team=$row['maximum_players']/2;
    if($result)
    {
    	$row1=$result->fetch_assoc();
    	$remaining=$team-$row1['SUM(team_b)'];
    	echo $remaining;
    }
    else
    {
    	echo $team;
    }
?>