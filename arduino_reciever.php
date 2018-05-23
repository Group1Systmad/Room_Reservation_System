<?php
    session_start();
      include "connect.php";
    if(isset($_GET['MAC'])){
       $pre_mac = $_GET['MAC'];
  $pre_array_mac = str_split($pre_mac);
  $count = 0;
  $post_mac = "";
  foreach($pre_array_mac as $char){
      $post_mac = $post_mac . $char;
      if ($count == 3 || $count == 7){
          $post_mac = $post_mac . ':';
      }
      $count++;
  }
   echo $post_mac; 
   $SQL3 = "SELECT tbl_room.room_id,tbl_room.emp_id,tbl_room.time_in,tbl_room.time_out,tbl_room.date,tbl_room.u_code,tbl_room.Status,tbl_room.time_millis,tbl_roomlist.mac_address" 
      . " FROM tbl_room JOIN tbl_roomlist ON tbl_room.room_id = tbl_roomlist.room_id WHERE mac_address='$post_mac'";
  
  $result = mysqli_query($con,$SQL3);
  $data = mysqli_fetch_assoc($result);
  
    $unique = $data['u_code'];
   echo $unique;
    $SQL2 = "DELETE FROM tbl_room";
mysqli_query($con,$SQL2);
$SQL = "SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY date,time_in";
$res = mysqli_query($con,$SQL);
$row = mysqli_fetch_array($res);
$res_id = $row['id'];
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
$SQL1 = "INSERT INTO tbl_room(id,room_id,emp_id,time_in,time_out,date,u_code,Status,time_millis) VALUES ('$res_id','$roomid','$empid','$timein','$timeout','$date','$ucode','$status','$millis_time')";
mysqli_query($con,$SQL1);
$SQL4 = "UPDATE tbl_sched SET Status = 0 WHERE u_code = '$unique'";
mysqli_query($con,$SQL4);
header('Content-type: application/json');
    }
      
    
  
  
 
?>