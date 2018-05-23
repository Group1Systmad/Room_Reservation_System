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
$type = $_POST['type'];
if ($type == 'User'){
    $atype = 'user';
}
else{
    $atype = 'admin';
}
include 'connect.php';

$SQL = "INSERT INTO employee(Employee_ID,Emp_FN,Emp_LN,Emp_Address,Emp_Age,Emp_Department,Emp_Email,Emp_Gender,Emp_CNumber) VALUES('$idno','$fn','$ln','$add','$age','$dept','$email','$gen','$contact')";
$SQL2 = "INSERT INTO accounts(Employee_ID,Acc_Uname,Acc_Pass,acc_type) VALUES('$idno','$uname','$pass','$atype')";

mysqli_query($con,$SQL);

mysqli_query($con,$SQL2);


header('location:employees.php');

mysqli_close($con);
?>

