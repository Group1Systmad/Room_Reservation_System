<?php
 
$empid = $_POST['txteid'];
$empln = $_POST['txteln'];
$empfn = $_POST['txtefn'];
$empadd = $_POST['txteaddr'];
$empdept = $_POST['txtedept'];
$empmail = $_POST['txtemail'];
$empcn = $_POST['txtecn'];

include 'connect.php';
$SQL = "UPDATE employee SET Emp_FN='$empfn',Emp_LN='$empln',Emp_Address='$empadd',Emp_Department='$empdept',"
        . " Emp_Email='$empmail',Emp_CNumber='$empcn' WHERE Employee_ID='$empid'";
mysqli_query($con,$SQL);

mysqli_close($con);

header('location:employees.php');
?>

