<?php
session_start();
include 'connect.php';
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

 $empid = $_SESSION['o_eid'];
 $SQL = "SELECT * FROM employee WHERE Employee_ID = '1234567890'";
 $result = mysqli_query($con, $SQL); 
 $row = mysqli_fetch_assoc($result);
 $ememail = $row['Emp_Email'];
$eid = $_SESSION['eid'];
$rid = $_SESSION['rid'];
$ti = $_SESSION['timein'];
$to = $_SESSION['timeout'];
$date = $_SESSION['date'];
$ucode = $_SESSION['ucode'];
$o_rid = $_SESSION['o_rid'];
$o_eid = $_SESSION['o_eid'];
$o_ti = $_SESSION['o_timein'];
$o_to = $_SESSION['o_timeout'];
$o_date = $_SESSION['o_date'];
$o_code = $_SESSION['o_code'];

 $mailcontent = "<html><body><center><p>There is some changes in your schedule.</p>"
         . "<h1>$o_rid >> $rid</h1>"
         . "<h1>$o_ti >> $ti</h1>"
         . "<h1>$o_to >> $to</h1>"
         . "<h1>$o_date >> $date</h1>"
         . "<h1>$o_code >> $ucode</h1>"
         . "</center></body></html>";
 $subject = "Change in Schedule";
 $from = "jdc42607@gmail.com";
 $headers = "From: " . strip_tags("jdc42607@gmail.com") . "\r\n";
 $headers .= "Reply-To: ". strip_tags("jdc42607@gmail.com") . "\r\n";
 $headers .= "CC: ". $ememail ."\r\n";
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 $success = mail($ememail, $subject, $mailcontent , $headers);
  if( $success == true )  
   {
      echo "Message sent successfully...";
      echo $from;
      echo $ememail;
      echo $subject;
      echo $mailcontent;
   }
   else
   {
      echo "Message could not be sent...";
      echo $from;
      echo $ememail;
      echo $subject;
      echo $mailcontent;
   }
//header('location:schedtable.php');

 
?>

