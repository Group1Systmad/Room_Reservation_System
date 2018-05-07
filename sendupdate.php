<?php
session_start();
include 'connect.php';
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

 $empid = $_SESSION['o_eid'];
 $SQL = "SELECT * FROM employee WHERE Employee_ID = '$empid'";
 $result = mysqli_query($con, $SQL); 
 $row = mysqli_fetch_assoc($result);
 $ememail = $row['Emp_Email'];
$eid = $_SESSION['eid'];
$rid = $_SESSION['rid'];
$ti = $_SESSION['timein'];
$to = $_SESSION['imeout'];
$date = $_SESSION['date'];
$ucode = $_SESSION['ucode'];
$o_rid = $_SESSION['o_rid'];
$o_eid = $_SESSION['o_eid'];
$o_ti = $_SESSION['o_timein'];
$o_to = $_SESSION['o_timeout'];
$o_date = $_SESSION['o_date'];
$o_code = $_SESSION['o_code'];

 $mailcontent = "<html><body><center><p>There is some changes in your schedule.</p>"
         . "<h1>$o_eid >> $eid</h1>"
         . "<h2>$o_rid >> $rid</h2>"
         . "<h3>$o_ti >> $ti</h3>"
         . "<h4>$o_to >> $to</h4>"
         . "<h5>$o_date >> $date</h5>"
         . "<h6>$o_code >> $ucode</h6>"
         . "</center></body></html>";
 $subject = "Change in Schedule";
 $from = "jdc42607@gmail.com";
 $headers = "From: " . strip_tags("jdc42607@gmail.com") . "\r\n";
 $headers .= "Reply-To: ". strip_tags("jdc42607@gmail.com") . "\r\n";
 $headers .= "CC: ". $email ."\r\n";
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 $success = mail($ememail, $subject, $mailcontent , $headers);
 
header('location:schedtable.php');

 
?>

