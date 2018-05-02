<?php
session_start();
include 'connect.php';
$SQL2 = "DELETE FROM tbl_room";
$res2 = mysqli_query($con,$SQL2);
$SQL = "SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY date,time_in";
$res = mysqli_query($con,$SQL);
$row = mysqli_fetch_array($res);
$roomid = $row['room_id'];
$empid = $row['emp_id'];
$timein = $row['time_in'];
$timeout = $row['time_out'];
$date = $row['date'];
$ucode = $row['u_code'];
$status = $row['Status'];
$time_in_stamp = strtotime($row['time_in']);
$time_out_stamp = strtotime($row['time_out']);
$time_in_f = date("H:i", $time_in_stamp);
$time_out_f = date("H:i", $time_out_stamp);
$nInterval = strtotime($time_out_f) - strtotime($time_in_f);
$millis_time = $nInterval * 1000;
$SQL1 = "INSERT INTO tbl_room(room_id,emp_id,time_in,time_out,date,u_code,Status,time_millis) VALUES ('$roomid','$empid','$timein','$timeout','$date','$ucode','$status','$millis_time')";
$res1 = mysqli_query($con,$SQL1);
if($_SESSION['acctype'] == 'admin'){
    $_SESSION['admin'] = true;
    $_SESSION['user'] = false;
}
else{
     $_SESSION['admin'] = false;
    $_SESSION['user'] = true;
}
if ($_SESSION['admin'] == true){
    $_SESSION['admin'] = false;
    if($_SESSION['deleted'] == true){
        $_SESSION['deleted'] = false;
        header('location:schedtable.php');
        
    }
    else{
        echo "<script>window.close(); </script>";
    }
 
mysqli_close($con);
}
else if ($_SESSION['users'] == true){
$_SESSION['users'] = false;
 echo "<script>window.close(); </script>";
mysqli_close($con);
}
?>

