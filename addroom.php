<?php
session_start();
$room_id = $_POST['txtrid'];
include 'connect.php';

$SQL = "SELECT * FROM tbl_roomlist WHERE room_id='$room_id'";
$res = mysqli_query($con, $SQL);
$count = mysqli_num_rows($res);
    if ($count == 1){
        $_SESSION['same'] = true;
        if ($_SESSION['type']=='admin'){
        header('location:addroomlist.php');}
        else if ($_SESSION['type']=='user'){
        header('location:addroomlist_user.php');}
    }
    else {
        $SQL1 = "INSERT INTO tbl_roomlist(room_id) VALUES('$room_id')";
        mysqli_query($con, $SQL1);
        if ($_SESSION['type']=='admin'){
        header('location:homepage.php');}
        else if ($_SESSION['type']=='user'){
        header('location:userpage.php');}
    }

        mysqli_close($con);
?>