<?php
$studID = $_POST['hid'];
$ln = $_POST['txtLN'];
$fn = $_POST['txtFN'];
$add = $_POST['txtAddress'];
$age = $_POST['txtAge'];
$dept = $_POST['txtDepartment'];
$email = $_POST['txtEmail'];
$gend = $_POST['txtG'];

include 'connect.php';

$SQL = "UPDATE employee SET Emp_LN='$ln',Emp_FN='$fn',Emp_Address='$add',Emp_Age='$age',Emp_Department='$dept',Emp_Email='$email',Emp_Gender='$gend' WHERE Employee_ID='$studID'";
mysqli_query($con,$SQL)or die('Error:'.mysqli_error($con));

mysqli_close($con);

header('location:employees.php');
?>

