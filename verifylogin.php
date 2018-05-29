<?php
session_start();
include 'connect.php';
$un = $_POST['uname'];
$pw = $_POST['pword'];
 
$SQL ="SELECT * FROM accounts WHERE Acc_Uname='$un' AND Acc_Pass='$pw'";
$result = mysqli_query($con,$SQL);
$row= mysqli_fetch_array($result);
$count = mysqli_num_rows($result); 

if ($count == 1)
  {
    if ($row['acc_type'] == 'admin'){
    $_SESSION['username'] = $un;
    $_SESSION['username_name'] = $un;
    $_SESSION['eid'] = "";
    $_SESSION['rid'] = "";
    $_SESSION['timein'] = "";
    $_SESSION['timeout'] = "";
    $_SESSION['date'] = "";
    $_SESSION['acctype'] = 'admin';
        //If the admin just recently forgotpassword
        if ($row['count'] == 1){
            header('location:change_pass.php');
        }
        //If the admin just recently forgotpassword end
        else {
            $_SESSION['login_name'] = 'hello';
            header('location:homepage.php');
        }
    }
    else if ($row['acc_type'] == 'user'){
    $_SESSION['username'] = $un;
    $_SESSION['username_name'] = $un;
    $_SESSION['ueid'] = "";
    $_SESSION['urid'] = "";
    $_SESSION['utimein'] = "";
    $_SESSION['utimeout'] = "";
    $_SESSION['udate'] = "";
    $_SESSION['username'] = $un;
    $_SESSION['acctype'] = 'user';
    //If the user just recently forgotpassword
    if ($row['count'] == 1){
        header('location:change_pass.php');
        }
    //If the user just recently forgotpassword end
    else {
        $_SESSION['login_name'] = 'hello';
        header('location:userpage.php');
        }
   
    }
    
  }
  else
  {
    $_SESSION["login"] = 'failed';
    header('location:login_page.php');
  }
  mysqli_close($con);
?>