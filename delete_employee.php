<?php

$EmpID = $_GET['SID'];
include 'connect.php';
$SQL = "UPDATE employee SET Emp_Status='INACTIVE' WHERE Employee_ID='$EmpID'";
mysqli_query($con,$SQL);

mysqli_close($con);

header('location:employees.php');
?>

