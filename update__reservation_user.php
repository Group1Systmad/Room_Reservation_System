<?php
session_start();
$id = $_SESSION['id'];
$r_id = $_SESSION['urid'];
$e_id = $_SESSION['ueid'];
$ti = $_SESSION['utimein'];
$to = $_SESSION['utimeout'];
$date = $_SESSION['udate'];
$u_code = $_SESSION['ucode'];

include 'connect.php';
$nInterval = strtotime($to) - strtotime($ti);
$millis_time = $nInterval * 1000;

$SQL = "UPDATE tbl_sched SET room_id='$r_id',emp_id='$e_id',time_in='$ti',time_out='$to',date='$date',u_code='$u_code',time_millis='$millis_time' WHERE id='$id'";
mysqli_query($con,$SQL)or die('Error:'.mysqli_error());

mysqli_close($con);
$_SESSION['eid'] = $e_id;
$_SESSION['rid'] = $r_id;
$_SESSION['timein'] = $ti;
$_SESSION['timeout'] = $to;
$_SESSION['date'] = $date;
$_SESSION['ucode'] = $u_code;
header('location:user_reservation.php');
?>