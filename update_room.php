<?php

include 'connect.php';

$SQL2 = "DELETE FROM tbl_room";
$res2 = mysqli_query($con,$SQL2);

$SQL = "SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY date,time_in";
$res = mysqli_query($con,$SQL);
$row = mysqli_fetch_array($res);
$roomid = $row['room_id'];
$empid = $row['emp_id'];
$timein = $row['time_in'];
$timeout = $row['time_out'];
$date = $row['date'];
$ucode = $row['u_code'];
$status = $row['Status'];
$SQL1 = "INSERT INTO tbl_room(room_id,emp_id,time_in,time_out,date,u_code,Status) VALUES ('$roomid','$empid','$timein','$timeout','$date','$ucode','$status')";
$res1 = mysqli_query($con,$SQL1);
header('location:schedtable.php');
mysqli_close($con);
?>

