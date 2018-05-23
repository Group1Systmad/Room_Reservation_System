<?php
session_start();
include 'connect.php';
$SQL2 = "DELETE FROM tbl_room";
$res2 = mysqli_query($con,$SQL2);
$SQL = "SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY date,time_in";
$res = mysqli_query($con,$SQL);
$row = mysqli_fetch_array($res);
$res_id = $row['id'];
$roomid = $row['room_id'];
$empid = $row['emp_id'];
$timein = $row['time_in'];
$timeout = $row['time_out'];
$date = $row['date'];
$ucode = $row['u_code'];
$status = $row['Status'];
$time_in_stamp = strtotime($row['time_in']);
$time_out_stamp = strtotime($row['time_out']);
$time_in_f = date("H:i", $time_in_stamp);
$time_out_f = date("H:i", $time_out_stamp);
$nInterval = strtotime($time_out_f) - strtotime($time_in_f);
$millis_time = $nInterval * 1000;
$SQL1 = "INSERT INTO tbl_room(id,room_id,emp_id,time_in,time_out,date,u_code,Status,time_millis) VALUES ('$res_id','$roomid','$empid','$timein','$timeout','$date','$ucode','$status','$millis_time')";
$res1 = mysqli_query($con,$SQL1);


mysqli_close($con);

?>