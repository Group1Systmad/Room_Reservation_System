<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  include "connect.php";
  
     $SQL = "SELECT * FROM arduino_test";
  $result = mysqli_query($con,$SQL);
  $rows = array();
  
  while ($row = mysqli_fetch_assoc($result)) {
    $rows['root'] = $row;
  }
  echo json_encode($rows);
  
  if (isset($_GET["submit_button"])) {
    $_SESSION["value_num"] = $_GET["value"]; 
    $value = (int) $_SESSION["value_num"];
    
    if ($value==1) {
    $bool = true;
    }
    else {
    $bool = false;
    }
    
    $SQL = "UPDATE arduino_test SET led_value = '$bool' WHERE id = 1";
    mysqli_query($con,$SQL) or die("Error: ". mysqli_error($con));
    
    mysqli_close($con);
    //header("location:turn_led.php");
  }
  //header("location:turn_led.php");
  
  
?>
