<?php
session_start();
$room_id = $_POST['txtrid'];
include 'connect.php';

$SQL = "SELECT * FROM tbl_roomlist WHERE room_id='$room_id'";
$res = mysqli_query($con, $SQL);
$count = mysqli_num_rows($res);
    if ($count == 1){
        $_SESSION['same'] = true;
        header('location:addroomlist.php');
    }
    else {
        $SQL1 = "INSERT INTO tbl_roomlist(room_id) VALUES('$room_id')";
        mysqli_query($con, $SQL1);
        $SQL3 = "SELECT * FROM tbl_roomlist";
        $res3 = mysqli_query($con, $SQL3);
        $nr = mysqli_num_rows($res3);
        $_SESSION['numrooms'] = $nr;
        header('location:homepage.php');
    }

        mysqli_close($con);
?>