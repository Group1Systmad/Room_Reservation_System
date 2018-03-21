<?php
$id = $_POST['hid'];
$r_id = $_POST['txtrid'];
$e_id = $_POST['txteid'];
$ti = $_POST['txtti'];
$to = $_POST['txtto'];
$date = $_POST['txtd'];

include 'connect.php';

$SQL = "UPDATE tbl_sched SET room_id='$r_id',emp_id='$e_id',time_in='$ti',time_out='$to',date='$date' WHERE id='$id'";
mysqli_query($con,$SQL)or die('Error:'.mysqli_error());

mysqli_close($con);

header('location:schedtable.php');
?>