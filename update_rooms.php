<?php

$rid = $_POST['roomid'];
$rid1 = $_POST['hid'];
$rname1 = $_POST['roomname'];
$rbldg1 = $_POST['roombldg'];
$rfloor1 = $_POST['roomfloor'];
$macaddr1 = $_POST['macaddr'];
$opentime = $_POST['timeframe_in'];
$closetime = $_POST['timeframe_out'];

include 'connect.php';

$SQL = "UPDATE tbl_roomlist SET room_id='$rid',room_name='$rname1',room_bldg='$rbldg1',room_floor='$rfloor1',mac_address='$macaddr1',timeframe_in='$opentime',timeframe_out='$closetime' WHERE room_id='$rid1'";
mysqli_query($con,$SQL)or die('Error:'.mysqli_error($con));

mysqli_close($con);

header('location:Room_View.php');
?>

