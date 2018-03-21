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
    $_SESSION["selected"]=filter_input(INPUT_POST,"reserv_id");
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

        $id = $_SESSION["selected"];
        $r_id = $_POST['room_id'];
        $e_id = $_POST['emp_id'];
        $ti = $_POST['time_in'];
        $to = $_POST['time_out'];
        $date = $_POST['date'];
        $unique_code = $_POST['unique'];
        if (isset($_POST['status'])){
            $room_status = true;
        }else{
            $room_status=false;
        }




        $SQL = "UPDATE tbl_sched SET room_id='$r_id',emp_id='$e_id',time_in='$ti',time_out='$to',date='$date',u_code='$unique_code',Status='$room_status' WHERE id='$id'";
        echo $SQL;
        mysqli_query($con,$SQL)or die('Error:'.mysqli_error());

        mysqli_close($con);
        echo "SESSION IS 3";



        $_SESSION["count"] = 1;
        $_SESSION["selected"] = "none";
//save
        header('location:schedtable.php');
    }
    else if ($_SESSION["count"] == 2){
        echo " if 2 Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
//set editable
        $_SESSION["classname"] = '.cell'.$_SESSION["selected"];
        header('location:schedtable.php');
    }
    else{
        echo "if 3 Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
        header('location:schedtable.php');
    }

}else{
    echo "Selected=".$_SESSION["selected"]. " ". "Previous=". $_SESSION["previous"];
    $_SESSION["count"] = 2;
    $_SESSION["previous"] = $_SESSION["selected"];
    $_SESSION["selected"] = $_GET["SID"];
    $_SESSION["classname"] = '.cell'.$_SESSION["selected"];
    header('location:schedtable.php');
}




?>