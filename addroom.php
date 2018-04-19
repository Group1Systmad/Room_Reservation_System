<?php
session_start();
$room_id = $_POST['txtrid'];
$room_n = $_POST['txtrn'];
$room_b = $_POST['txtrb'];
$room_f = $_POST['txtrf'];
$room_ma = $_POST['txtrma'];
include 'connect.php';

$SQL = "SELECT * FROM tbl_roomlist WHERE room_id='$room_id'";
$res = mysqli_query($con, $SQL);
$count = mysqli_num_rows($res);
    if ($count == 1){
        $_SESSION['same'] = true;
        header('location:addroomlist.php');
    }
    else {
        $SQL1 = "INSERT INTO tbl_roomlist(room_id,room_name,room_bldg,room_floor,mac_address) VALUES('$room_id','$room_n','$room_b','$room_f','$room_ma')";
        mysqli_query($con, $SQL1);
        
        header('location:room_view.php');
    }

        mysqli_close($con);
?>