<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
$connection = new mysqli("localhost","root","","db_sched");

if($_POST)
{
    
    $email = $_POST['email'];
    $selectquery = mysqli_query($connection,"select * from accounts where Acc_email='{$email}'") or die(mysqli_error($connection));
    $count = mysqli_num_rows($selectquery);
    $row = mysqli_fetch_array($selectquery);
    
    if($count>0)
        {
       // echo $row['Acc_Pass'];

     if(isset($_POST['email'])){   
        require 'PHPMailerAutoload.php';    
        
        $mail = new PHPMailer;

      $mail->SMTPDebug = 4;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPauth = true;
      $mail->Username = 'alaindannpaciteng@gmail.com';
      $mail->Password = 'nexus777esports';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      
      $mail->setFrom('alaindannpaciteng@gmail.com','Spa Demo');
      $mail->addAddress('$email','$email');
              
      $mail->isHTML(true);
      $mail->Subject = $_POST['Forgot password'];
      $mail->Body = "Hi $email your Password is {row['Acc_Pass']}";
      $mail->AltBody = "Hi $email your Password is {row['Acc_Pass']}";
      if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

              
    
     }
}
else
{
    echo"<script>alert('Email not found');</script>";
}
}
?>
<html>
    <body>
        <form method="post">
            Email:<input type="email" name="email">
            <input type="submit">
            </form>
    </body>

