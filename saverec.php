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
$type = $_POST['type'];
$contact = $_POST['txtContactNumber'];
include 'connect.php';
if ($type == 'Admin'){
    $rtype = 'admin';
}
else{
    $rtype = ' user';
}
$SQL = "INSERT INTO employee(Employee_ID,Emp_FN,Emp_LN,Emp_Address,Emp_Age,Emp_Department,Emp_Email,Emp_Gender,Emp_CNumber) VALUES('$idno','$fn','$ln','$add','$age','$dept','$email','$gen','$contact')";
$SQL2 = "INSERT INTO accounts(Employee_ID,Acc_Uname,Acc_Pass,acc_type,count) VALUES('$idno','$uname','$pass','$rtype',1)";

mysqli_query($con,$SQL);

mysqli_query($con,$SQL2);


header('location:employees.php');

mysqli_close($con);
?>

