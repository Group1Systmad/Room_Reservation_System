<?php
/**
 * Created by PhpStorm.
 * User: Marjay
 * Date: 3/11/2018
 * Time: 10:57 PM
 */
include 'connect.php';
session_start();
echo "seesion startuuu";

if (isset($_POST["save_button"])){
    $_SESSION["previous"] = $_SESSION["selected"];
    $_SESSION["selected"]=filter_input(INPUT_POST,"emp_id");
}
elseif($_SESSION["selected"]=="none"){
    $_SESSION["selected"]=$_GET["SID"];
    $_SESSION["previous"] = $_SESSION["selected"];
}
else{
    $_SESSION["previous"] = $_SESSION["selected"];
    $_SESSION["selected"] = $_GET["SID"];
}



if($_SESSION["previous"] == $_SESSION["selected"]){
    $_SESSION["count"] += 1;
    if($_SESSION["count"] == 3) {
        echo $_SESSION["selected"];

        $emp_id = $_SESSION["selected"];
//        $emp_id = $_POST['emp_id'];
        $emp_ln = $_POST['emp_ln'];
        $emp_fn = $_POST['emp_fn'];
        $emp_add = $_POST['emp_add'];
        $emp_age = $_POST['emp_age'];
        $emp_dept = $_POST['emp_dept'];
        $emp_email = $_POST['emp_email'];
        $gender = $_POST['gender'];
        $cnumber = $_POST['emp_cnumber'];

        $SQL = "UPDATE employee SET Employee_ID='$emp_id',Emp_FN='$emp_fn',Emp_LN='$emp_ln',Emp_Address='$emp_add',
Emp_Age='$emp_age',Emp_Department='$emp_dept',Emp_Gender='$gender',Emp_CNumber = '$cnumber' WHERE Employee_ID='$emp_id'";
        echo $SQL;
        mysqli_query($con,$SQL)or die('Error:'.mysqli_error());

        mysqli_close($con);
        echo "SESSION IS 3";



        $_SESSION["count"] = 1;
        $_SESSION["selected"] = "none";
//save
        header('location:employees.php');
    }
    else if ($_SESSION["count"] == 2){
//set editable
        $_SESSION["classname"] = '.cell'.$_SESSION["selected"];
        header('location:employees.php');
    }
    else{
        header('location:employees.php');
    }

}else{
    $_SESSION["count"] = 2;
    $_SESSION["previous"] = $_SESSION["selected"];
    $_SESSION["selected"] = $_GET["SID"];
    $_SESSION["classname"] = '.cell'.$_SESSION["selected"];
    header('location:employees.php');
}




?>