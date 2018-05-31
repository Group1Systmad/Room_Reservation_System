
<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
  
  $SQL2 = "DELETE FROM tbl_room";
$res2 = mysqli_query($con,$SQL2);
$SQL3 = "SELECT * FROM tbl_roomlist WHERE mac_address=$post_mac'";
$res3 = mysqli_query($con,$SQL3);
$row1 = mysqli_fetch_array($res3);
$room_id = $row1['room_id'];
date_default_timezone_set('Asia/Manila');
$date_current = date('Y-m-d');
$time_current = date('H:i:s');
$SQL = "SELECT * FROM tbl_sched WHERE Status = '1' AND room_id = '$room_id'";
$res = mysqli_query($con,$SQL);
$count1 = mysqli_num_rows($res);
$i = -1;
while($row = mysqli_fetch_array($res))
            {
                $i++;
                $col[$i]['time_in']=$row['time_in'];
                $col[$i]['time_out']=$row['time_out'];
                $col[$i]['date']=$row['date'];
                $col[$i]['id']=$row['id'];
            }       
            if ($count>=1){
                for ($j=0;$j<=$i;$j++){
                    $time_in_stamp = strtotime($col[$j]['time_in']);
                    $time_out_stamp = strtotime($col[$j]['time_out']);
                    $time_in_f = date("H:i", $time_in_stamp);
                    $time_out_f = date("H:i", $time_out_stamp);
                    $id[$j] = $col[$j]['id'];
                    if ($col[$j]['date'] < $date_current){
                        $SQL3 = "UPDATE tbl_sched SET Status='0' WHERE id='$id[$j]'";
                        $res4 = mysqli_query($con,$SQL3);
                    }
                    else if ($col[$j]['date'] == $date_current){
                        if ($time_out_f < $time_current){
                            $SQL3 = "UPDATE tbl_sched SET Status='0' WHERE id='$id[$j]'";
                            $res4 = mysqli_query($con,$SQL3);
                        }
                    }
                }
            }
$SQL4 = "SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY date,time_in";
$res4 = mysqli_query($con,$SQL4);
$row4 = mysqli_fetch_array($res4);
$res_id = $row4['id'];
$roomid = $row4['room_id'];
$empid = $row4['emp_id'];
$timein = $row4['time_in'];
$timeout = $row4['time_out'];
$date = $row4['date'];
$ucode = $row4['u_code'];
$status = $row4['Status'];
$time_in_stamp = strtotime($row4['time_in']);
$time_out_stamp = strtotime($row4['time_out']);
$time_in_f = date("H:i", $time_in_stamp);
$time_out_f = date("H:i", $time_out_stamp);
$nInterval = strtotime($time_out_f) - strtotime($time_in_f);
$millis_time = $nInterval * 1000;
$SQL1 = "INSERT INTO tbl_room(id,room_id,emp_id,time_in,time_out,date,u_code,Status,time_millis) VALUES ('$res_id','$roomid','$empid','$timein','$timeout','$date','$ucode','$status','$millis_time')";
$res1 = mysqli_query($con,$SQL1);  
  
  
    $SQL3 = "SELECT tbl_room.id,tbl_room.room_id,tbl_room.emp_id,tbl_room.time_in,tbl_room.time_out,tbl_room.date,tbl_room.u_code,tbl_room.Status,tbl_room.time_millis,tbl_roomlist.mac_address" 
        . " FROM tbl_room JOIN tbl_roomlist ON tbl_room.room_id = tbl_roomlist.room_id WHERE mac_address='$post_mac'"; 
  
     $SQL5 = "SELECT * FROM tbl_room";
  $result = mysqli_query($con,$SQL3);
  $data = mysqli_fetch_assoc(   $result);
  while ($row= mysqli_fetch_assoc($result)) {
    $id = $row['room_id'];
    $unique = $row['u_code'];
  }
  
header('Content-type: application/json');
echo json_encode($data);
  }
  
  if(isset($_GET['RID'])){
      $RID = $_GET['RID'];
      $SQL4 = "SELECT Status FROM tbl_sched WHERE id = '$RID'";
      $result2 = mysqli_query($con, $SQL4);
      $data2 = mysqli_fetch_assoc(   $result2);
  
header('Content-type: application/json');
echo json_encode($data2);
  }
  
  
  

  
  
  
?>
