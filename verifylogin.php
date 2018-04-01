<?php
session_start();
include 'connect.php';
$_SESSION['incorrect'] = $un;
$un = $_POST['uname'];
$pw = $_POST['pword'];

$SQL ="SELECT * FROM accounts WHERE Acc_Uname='$un' AND Acc_Pass='$pw'";

$result = mysqli_query($con,$SQL);
$row= mysqli_fetch_array($result);

$count = mysqli_num_rows($result); //recordcount
//verifylogin.php
if ($count == 1)
  {
    if ($row['acc_type'] == 'admin'){
    session_start();
    $_SESSION['username'] = $un;
     $_SESSION['acctype'] = 'admin';
    header('location:homepage.php');
   
    }
    else if ($row['acc_type'] == 'user'){
    session_start();
    $_SESSION['username'] = $un;
     $_SESSION['acctype'] = 'user';
    header('location:userpage.php');
   
    }
  }
  else
  {
      $_SESSION["incorrect"] = true;
     header('location:login_page.php');
  }

  mysqli_close($con);
?>