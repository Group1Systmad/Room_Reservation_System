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
        echo " if 1 Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
        echo $_SESSION["selected"];

        $emp_id = $_SESSION["selected"];
        $emp_fn = $_POST['emp_fn'];
        $emp_ln = $_POST['emp_ln'];
        $emp_add = $_POST['emp_add'];
        $emp_age = $_POST['emp_age'];
        $emp_dep = $_POST['emp_dep'];
        $emp_email = $_POST['emp_email'];
        $emp_gen = $_POST['emp_gen'];
        $emp_cno = $_POST['emp_cno'];
        $emp_uname = $_POST['emp_uname'];
        $emp_pass = $_POST['emp_pass'];
       


        $SQL = "UPDATE accounts SET Acc_Uname='$emp_uname',Acc_Pass='$emp_pass' WHERE Employee_ID='$emp_id'";
        echo $SQL;
        mysqli_query($con,$SQL)or die('Error:'.mysqli_error());

        $SQL1 = "UPDATE employee SET Employee_ID='$emp_id',Emp_FN='$emp_fn',Emp_LN='$emp_ln',Emp_Address='$emp_add',Emp_Age='$emp_age',Emp_Department='$emp_dep',Emp_Email='$emp_email',Emp_Gender='$emp_gen',Emp_CNumber='$emp_cno' WHERE Employee_ID='$emp_id'";
        echo $SQL1;
        mysqli_query($con,$SQL1)or die('Error:'.mysqli_error());

        mysqli_close($con);
        echo "SESSION IS 3";



        $_SESSION["count"] = 1;
        $_SESSION["selected"] = "none";
//save
        header('location:user_account.php');
    }
    else if ($_SESSION["count"] == 2){
        echo " if 2 Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
//set editable
        $_SESSION["classname"] = '.cell'.$_SESSION["selected"];
        $_SESSION['username'] = $emp_uname;
        header('location:user_account.php');
    }
    else{
        echo "if 3 Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
        $_SESSION['username'] = $emp_uname;
        header('location:user_account.php');
    }

}else{
    echo "Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
    $_SESSION["count"] = 2;
    $_SESSION["previous"] = $_SESSION["selected"];
    $_SESSION["selected"] = $_GET["SID"];
    $_SESSION["classname"] = '.cell'.$_SESSION["selected"];
    $_SESSION['username'] = $emp_uname;
    header('location:user_account.php');
}




?>