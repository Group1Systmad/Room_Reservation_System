<?php
$idno = $_POST['txtID'];
$ln = $_POST['txtLN'];
$fn = $_POST['txtFN'];
$add = $_POST['txtAddress'];
$age = $_POST['txtAge'];
$dept = $_POST['txtDepartment'];
$email = $_POST['txtEmail'];
$gen = $_POST['gender'];
$uname = $_POST['txtUser'];
$pass = $_POST['txtPass'];
$contact = $_POST['txtContactNumber'];
include 'connect.php';

$SQL = "INSERT INTO employee VALUES('$idno','$fn','$ln','$add','$age','$dept','$email','$gen','$contact')";
$SQL2 = "INSERT INTO accounts(Employee_ID,Acc_Uname,Acc_Pass) VALUES('$idno','$uname','$pass')";

mysqli_query($con,$SQL);

mysqli_query($con,$SQL2);


header('location:employees.php');

mysqli_close($con);
?>

