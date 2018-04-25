<?php
session_start();
include 'connect.php';
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

 if(isset($_POST['submit_button'])){
     $email = $_POST['email'];
     $_SESSION['user_email'] = $email;
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
         $success = mail($email, $subject, $mailcontent , $headers);
         
         if($success != false){
             $SQL = "SELECT Employee_ID FROM employee WHERE Emp_Email = '$email'";
             
             $result = mysqli_query($con, $SQL);
             
             $row = mysqli_fetch_assoc($result);
             $id = $row['Employee_ID'];
             echo $id;
             $SQL = "UPDATE accounts SET Acc_Pass = '$password' WHERE Employee_ID = '$id'";
             mysqli_query($con, $SQL) or die(mysqli_error($con));
             header("location:forgot_redirect.php");
         }
     }
     
 }
?>
<html>
    <head>
        <title>Forgot Password Form</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body,html{
                width: 100%;
            }
            body{
               margin: 0;
               padding: 0;
               background: url('ben.jpg');
               background-size: cover; 
               background-repeat: no-repeat;
            }
             .parent{
                height: 100%;
                background: rgba(0,0,0,0);
                padding: 10px;
                margin: 0 auto;
            }
            .child{
                width:400px;
                height:345px;
                background: #ffffff;
                margin:10% auto;
                border-radius: 5px;
                
            }
            h1{
                padding-top: 50px; 
                color: #0086E5;
                font-weight: 700;
                text-align: center;
            }
              .form_container{
                text-align: center;
                display: flex;
                flex-direction: column; 
                flex-basis: 10px;
            }
            
            .container{
                padding-top: 10%;
                margin: 0 auto;
                width: 300px;
                height: 14%;
                
            }
            .button{
                margin-top: 10px;
            }
        </style>
    </head>   
    <body>
         <div class="parent">
            <div class="child">
                <h1 class="text">Forgot Password?</h1>
                <div class="container">
                    
                    <form method="post" action="forgotpassword.php" class="form_container">
                        <p class="text">Please enter your email address in the text box below to send you a temporary password.</p>
                        <input class="form-control text-center" type="email" name="email" placeholder="Your Email Here" 
                            <?php echo (isset($_SESSION['user_email'])) ? 'value = \'' . $_SESSION['user_email'].'\'' : ""; ?>>
                       <input class="button btn btn-primary" type="submit" name="submit_button">
                       
                    </form>
                    <a href="login_page.php"> <button class="btn btn-danger">Back</button></a><br>
                </div>   
            </div>
        </div>
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