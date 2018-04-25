<?php

$rid = $_GET['SID'];
include 'connect.php';
$SQL = "DELETE FROM tbl_roomlist WHERE room_id='$rid'";
mysqli_query($con,$SQL);

mysqli_close($con);

header('location:Room_View.php');
?>