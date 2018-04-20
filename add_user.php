<?php
session_start();
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
if(mysql_query($query)){
echo '<script language="javascript">';
        echo 'alert("Reservation Added!")';
        echo '</script>';
echo "<script>window.close();</script>";}
$_SESSION['users'] = true;
$_SESSION['admin'] = false;
header('location:update_room.php');
mysqli_close($con);
?>