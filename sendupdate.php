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
 $empln = $row['Emp_LN'];
$eid = $_SESSION['eid'];
$eeid = $_SESSION['eeid'];
$SQL1 = "SELECT * FROM employee WHERE Employee_ID = '$eeid'";
 $result1 = mysqli_query($con, $SQL1); 
 $row1 = mysqli_fetch_assoc($result1);
 $eename = $row1['Emp_LN'];
 $eecno = $row1['Emp_CNumber'];
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

if ($rid != $o_rid){
    $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
         . "<center><h1>Yout reservation's room was moved from Room $o_rid to Room $rid."
         . "Your reservation was edited by Mr./Ms. $eename."
         . "Please contact $eecno for more details.</h1>"
         . "</center></body></html>";
    if ($ti != $o_ti){
        $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
         . "<center><h1>Yout reservation's room was moved from Room $o_rid to Room $rid and your time from $o_ti - $o_to to $ti - $to."
         . "Your reservation was edited by Mr./Ms. $eename."
         . "Please contact $eecno for more details.</h1>"
         . "</center></body></html>";
        if ($date != $o_date){
            $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
             . "<center><h1>Yout reservation's room was moved from Room $o_rid to Room $rid and your time into $ti - $to. and date to $date."
             . "Your reservation was edited by Mr./Ms. $eename."
             . "Please contact $eecno for more details.</h1>"
             . "</center></body></html>";       
        
        }
    }
    else if ($date != $o_date){
        $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
         . "<center><h1>Yout reservation's room was moved from Room $o_rid to Room $rid and your date to $date."
         . "Your reservation was edited by Mr./Ms. $eename."
         . "Please contact $eecno for more details.</h1>"
         . "</center></body></html>";
    
    }
}
else if ($ti != $o_ti){
        $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
         . "<center><h1>Yout reservation's time was moved from $o_ti - $o_to to $ti - $to."
         . "Your reservation was edited by Mr./Ms. $eename."
         . "Please contact $eecno for more details.</h1>"
         . "</center></body></html>";
        if ($date != $o_date){
            $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
             . "<center><h1>Yout reservation's time was changed into $ti - $to. and date to $date."
             . "Your reservation was edited by Mr./Ms. $eename."
             . "Please contact $eecno for more details.</h1>"
             . "</center></body></html>";      
        }
}
else if ($date != $o_date){
        $mailcontent = "<html><body><p>Good Day Sir/Ma'am $empln,.</p>"
         . "<center><h1>Yout reservation's date was moved from $o_date to $date."
         . "Your reservation was edited by Mr./Ms. $eename."
         . "Please contact $eecno for more details.</h1>"
         . "</center></body></html>";
} 

 
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

