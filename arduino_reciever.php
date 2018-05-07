<?php
    session_start();
      include "connect.php";
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
  
  $SQL3 = "SELECT tbl_room.room_id,tbl_room.emp_id,tbl_room.time_in,tbl_room.time_out,tbl_room.date,tbl_room.u_code,tbl_room.Status,tbl_room.time_millis,tbl_roomlist.mac_address" 
      . " FROM tbl_room JOIN tbl_roomlist ON tbl_room.room_id = tbl_roomlist.room_id WHERE mac_address='$post_mac'";
  
  $result = mysqli_query($con,$SQL3);
  $data = mysqli_fetch_assoc($result);
  
    $unique = $data['u_code'];
  
  
  $SQL2 = "UPDATE tbl_sched SET Status = 0 WHERE u_code = '$unique'";
  mysqli_query($con,$SQL2);

  echo "Success";  
  
  mysqli_close($con);
?>