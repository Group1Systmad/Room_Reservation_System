<?php
session_start();
$r_id = $_SESSION['urid'];
$e_id = $_SESSION['ueid'];
$ti = $_SESSION['utimein'];
$to = $_SESSION['utimeout'];
$date = $_SESSION['udate'];
$u_code = $_SESSION['ucode'];

include 'connect.php';
$nInterval = strtotime($to) - strtotime($ti);
$millis_time = $nInterval * 1000;
$SQL = "INSERT INTO tbl_sched(room_id,emp_id,time_in,time_out,date,u_code,Status,time_millis) VALUES('$r_id','$e_id','$ti','$to','$date','$u_code',TRUE,$millis_time)";
mysqli_query($con,$SQL);
$_SESSION['user'] = true;
$_SESSION['admin'] = false;
$_SESSION['error'] = 'no';
$_SESSION['deleted'] = true;
header('location:update_room.php');
mysqli_close($con);
?>