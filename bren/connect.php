<?php
  $con = mysqli_connect("localhost","root","");
$select_db=mysqli_select_db($con,"db_sched");
if (!$select_db)
	{
		die('Could not connect:' .mysqli_error($con));
	}
?>

