<?php

$ID = $_GET['SID'];
include 'connect.php';
$SQL = "DELETE FROM tbl_sched WHERE id='$ID'";
mysqli_query($con,$SQL);

mysqli_close($con);

header('location:schedtable.php');
?>