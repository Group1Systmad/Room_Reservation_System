<?php
$id = $_POST['txtid'];
$r_id = $_POST['txtrid'];
$e_id = $_POST['txteid'];
$ti = $_POST['txtti'];
$to = $_POST['txtto'];
$date = $_POST['txtd'];
$u_code = $_POST['txtuc'];

include 'connect.php';

$SQL = "INSERT INTO tbl_sched(room_id,emp_id,time_in,time_out,date,u_code,Status) VALUES('$r_id','$e_id','$ti','$to','$date','$u_code',TRUE)";
mysqli_query($con,$SQL);
header('location:schedtable.php');
mysqli_close($con);
?>