<?php
session_start();
include 'connect.php';
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

 $empid = $_POST['Employee_ID'];
 $SQL = "SELECT Emp_Email  FROM employee WHERE Employee_ID = '$empid'";
 $SQL1 = "SELECT room_id FROM tbl_sched WHERE Employee_ID = '$empid'";
 $result = mysqli_query($con, $SQL); 
 $row = mysqli_fetch_assoc($result);
 $ememail = $row['Emp_Email'];
 $result1 = mysqli_query($con, $SQL1);
 $row1 = mysqli_fetch_assoc($result1);
 $roomno = $row1['room_id'];
 
 $mailcontent = "<html><body><center><p>There is some changes in terms of your room. You have been assigned in room no. </p><h1>$roomid</h1></center></body></html>";
 $subject = "Password Reset Email";
 $from = "jdc42607@gmail.com";
 $headers = "From: " . strip_tags("jdc42607@gmail.com") . "\r\n";
 $headers .= "Reply-To: ". strip_tags("jdc42607@gmail.com") . "\r\n";
 $headers .= "CC: ". $email ."\r\n";
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 $success = mail($email, $subject, $mailcontent , $headers);
 

 
?>

//may kulang
