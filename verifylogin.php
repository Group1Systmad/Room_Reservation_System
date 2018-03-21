<?php
session_start();
include 'connect.php';
$_SESSION['incorrect'] = $un;
$un = $_POST['uname'];
$pw = $_POST['pword'];

$SQL ="SELECT * FROM accounts WHERE Acc_Uname='$un' AND Acc_Pass='$pw'";

$result = mysqli_query($con,$SQL);
$res1 = mysqli_query($con,$SQL['acc_type']);

$count = mysqli_num_rows($result); //recordcount
//verifylogin.php
if ($count == 1)
  {
    if ($res1 == 'admin'){
    session_start();
    $_SESSION['username'] = $un;
    header('location:homepage.php');
    }
    else if ($res1 == 'user'){
    session_start();
    $_SESSION['username'] = $un;
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