
<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
  
     $SQL = "SELECT * FROM tbl_room";
  $result = mysqli_query($con,$SQL3);
  $data = mysqli_fetch_assoc(   $result);
  while ($row= mysqli_fetch_assoc($result)) {
    $id = $row['room_id'];
    $unique = $row['u_code'];
  }
  
header('Content-type: application/json');
echo json_encode($data);

  if (isset($_GET["switch_button"])) {
    $value = $_GET["value"]; 
    echo $value;
        
    if ($value=="on") {
    $bool = true;
    }
    else {
    $bool = false;
    }
    echo $value;
    $SQL = "UPDATE arduino_test SET led_value = '$bool' WHERE id = 1";
    mysqli_query($con,$SQL) or die("Error: ". mysqli_error($con));
    
    mysqli_close($con);
    //header("location:turn_led.php");
  }
  //header("location:turn_led.php");
  
  
?>
