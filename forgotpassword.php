<?php
include 'connect.php';
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

 if(isset($_POST['submit_button'])){
     $email = $_POST['email'];
     
     $SQL = "SELECT * FROM employee WHERE Emp_Email = '$email'";
     $result_set = mysqli_query($con,$SQL);
     
     $numrows = mysqli_num_rows($result_set);
     
     if ($numrows == 1) {
         //insert code to email here
         $password = generatePassword();
         $mailcontent = "<html><body><center><p>Your password has been reset. Please use the following code as your temporary password</p><h1>$password</h1></center></body></html>";
         $subject = "Password Reset Email";
         $from = "jdc42607@gmail.com";
         $headers = "From: " . strip_tags("jdc42607@gmail.com") . "\r\n";
        $headers .= "Reply-To: ". strip_tags("jdc42607@gmail.com") . "\r\n";
        $headers .= "CC: ". $email ."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
         mail($email, $subject, $mailcontent , $headers);
     }
     
 }
?>
<html>
    <body>
        <form method="post" action="forgotpassword.php">
            Email:<input type="email" name="email">
            <input type="submit" name="submit_button">
            </form>
    </body>

<?php
function generatePassword(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characterslength = strlen($characters);
    $randomstring = '';
    for($i = 0; $i < 10;$i++){
        $randomstring .= $characters[rand(0,$characterslength - 1)];
    }
    return $randomstring;
}

?>