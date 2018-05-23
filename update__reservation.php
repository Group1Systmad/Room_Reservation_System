<?php
session_start();
$id = $_SESSION['id'];
$r_id = $_SESSION['rid'];
$e_id = $_SESSION['eid'];
$ti = $_SESSION['timein'];
$to = $_SESSION['timeout'];
$date = $_SESSION['date'];
$u_code = $_SESSION['ucode'];

include 'connect.php';

$SQL = "UPDATE tbl_sched SET room_id='$r_id',emp_id='$e_id',time_in='$ti',time_out='$to',date='$date',u_code='$u_code' WHERE id='$id'";
mysqli_query($con,$SQL)or die('Error:'.mysqli_error());

mysqli_close($con);
$_SESSION['eid'] = $e_id;
$_SESSION['rid'] = $r_id;
$_SESSION['timein'] = $ti;
$_SESSION['timeout'] = $to;
$_SESSION['date'] = $date;
$_SESSION['ucode'] = $u_code;
header('location:sendupdate.php');
?>