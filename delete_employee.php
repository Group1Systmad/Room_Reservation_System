<?php

$EmpID = $_GET['SID'];
include 'connect.php';
$SQL = "DELETE FROM employee WHERE Employee_ID='$EmpID'";
mysqli_query($con,$SQL);

mysqli_close($con);

header('location:employees.php');
?>

