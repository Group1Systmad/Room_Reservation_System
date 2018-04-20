<?php
session_start();
include 'connect.php';
$un = $_POST['uname'];
$pw = $_POST['pword'];
$_SESSION['incorrect'] = $un;
 
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
    $_SESSION['username_name'] = $un;
    $_SESSION['eid'] = "";
    $_SESSION['rid'] = "";
    $_SESSION['timein'] = "";
    $_SESSION['timeout'] = "";
     $_SESSION['date'] = "";
    $_SESSION['acctype'] = 'admin';
        if ($row['count'] == 1){
            header('location:change_pass.php');
        }
        else {
            header('location:homepage.php');
        }
    }
    else if ($row['acc_type'] == 'user'){
    session_start();
    $_SESSION['username'] = $un;
    $_SESSION['username_name'] = $un;
    $_SESSION['urid'] = "";
    $_SESSION['utimein'] = "";
    $_SESSION['utimeout'] = "";
    $_SESSION['udate'] = "";
    $_SESSION['username'] = $un;
     $_SESSION['acctype'] = 'user';
     if ($row['count'] == 1){
            header('location:change_pass.php');
        }
         else {
            header('location:userpage.php');
        }
   
    }
        
  else
  {
      $_SESSION["incorrect"] = true;
     header('location:login_page.php');
  }
  }
  mysqli_close($con);
?>