<?php
session_start();
$r_id = $_SESSION['rid'];
$e_id = $_POST['txteid'];
$ti = $_POST['txtti'];
$to = $_POST['txtto'];
$date = $_POST['txtd'];
$u_code = $_POST['txtuc'];

include 'connect.php';

$SQL = "INSERT INTO tbl_sched(room_id,emp_id,time_in,time_out,date,u_code,Status) VALUES('$r_id','$e_id','$ti','$to','$date','$u_code',TRUE)";
mysqli_query($con,$SQL);
$_SESSION['users'] = false;
$_SESSION['admin'] = true;
$_SESSION['error'] = 'no';
header('location:update_room.php');
mysqli_close($con);
?>