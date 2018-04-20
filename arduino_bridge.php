
<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  include "connect.php";
  
  $SQL3 = "SELECT tbl_room.room_id,tbl_room.emp_id,tbl_room.time_in,tbl_room.time_out,tbl_room.date,tbl_room.u_code,tbl_room.Status,tbl_room.time_millis,tbl_roomlist.mac_address" 
      . " FROM tbl_room JOIN tbl_roomlist ON tbl_room.room_id = tbl_roomlist.room_id"; 
  
     $SQL = "SELECT * FROM tbl_room";
  $result = mysqli_query($con,$SQL3);
  $data = mysqli_fetch_assoc($result);
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
