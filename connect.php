<?php
  $con = mysqli_connect("localhost","admin","admin1234");

if (!$con)
	{
		die('Could not connect:' .mysqli_error($con));
	}

$select_db=mysqli_select_db($con,"db_sched");
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($con));
}

?>