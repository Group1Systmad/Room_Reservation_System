<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  include "connect.php";
  $id = $_GET["id"];
  
  $SQL = "SELECT Acc_Uname FROM accounts WHERE Account_ID = $id";
  $result = mysqli_query($con,$SQL);
  
  while ($row= mysqli_fetch_assoc($result)) {
    $name = $row['Acc_Uname'];
}
  
  
  echo $row['Acc_Uname'];
  
?>
<h1><?php echo $row['Acc_Uname'];?></h1>