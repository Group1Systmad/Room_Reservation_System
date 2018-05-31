<?php
session_start();
$r_id = $_SESSION['rid'];
$e_id = $_SESSION['eid'];
$ti = $_SESSION['timein'];
$to = $_SESSION['timeout'];
$date = $_SESSION['date'];
$u_code = $_SESSION['ucode'];

include 'connect.php';
$nInterval = strtotime($to) - strtotime($ti);
$millis_time = $nInterval * 1000;
$SQL = "INSERT INTO tbl_sched(room_id,emp_id,time_in,time_out,date,u_code,Status,time_millis) VALUES('$r_id','$e_id','$ti','$to','$date','$u_code',TRUE,$millis_time)";
mysqli_query($con,$SQL);
$_SESSION['users'] = false;
$_SESSION['admin'] = true;
$_SESSION['error'] = 'no';
$_SESSION['deleted'] = true;
header('location:update_room.php');
mysqli_close($con);
?>