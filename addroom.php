<?php
session_start();
$room_id = $_POST['txtrid'];
$room_name = $_POST['roomname']; 
$room_bldg = $_POST['roombldg'];
$room_flr = $_POST['roomfloor'];
$mac_address = $_POST['macaddr'];
$opentime = $_POST['timeframe_in'];
$closetime = $_POST['timeframe_out'];
include 'connect.php';
//Get data from tbl_roomlist
$SQL = "SELECT * FROM tbl_roomlist WHERE room_id='$room_id'";
$res = mysqli_query($con, $SQL);
//Get data from tbl_roomlist
$count = mysqli_num_rows($res);
    //Check if admin or user
    if ($count == 1){
        $_SESSION['same'] = true;
        if ($_SESSION['type']=='admin'){
        header('location:addroomlist.php');}
        else if ($_SESSION['type']=='user'){
        header('location:addroomlist_user.php');}
    }
    //Check if admin or user
    //Insert into tbl_roomlist new data
    else {
        $SQL1 = "INSERT INTO tbl_roomlist (room_id,room_name,room_bldg,room_floor,mac_address,timeframe_in,timeframe_out) "
                . "VALUES('$room_id','$room_name','$room_bldg','$room_flr','$mac_address','$opentime','$closetime')";
        mysqli_query($con, $SQL1);
        if ($_SESSION['type']=='admin'){
        header('location:Room_View.php');}
        else if ($_SESSION['type']=='user'){
        header('location:userpage.php');}
    }
    //Insert into tbl_roomlist new data
        mysqli_close($con);
?>