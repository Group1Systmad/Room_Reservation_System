<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <style>
            .parent{
                height: 100%;
                background: rgba(0,0,0,0);
                padding: 10px;
                margin: 0 auto;
            }
            .child{
                width:400px;
                height:500px;
                background: rgba(0,0,0,0.2);
                margin:10% auto;
                border-radius: 5px;
                
            }
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
            .input-child{   
                padding: 10px;
                margin: 10px;
                border: 0;
                border-radius: 3px;
                background: #ffffff;
            }
            .container{
                padding-top: 20%;
                margin: 0 auto;
                width: 215px;
                height: 14%;
                
            }
            .avatar{
                position: relative;
                width: 150px;
                height: 150px;
                top: 0px;
                left: 35px; 
            }
            .form_container{
                text-align: center;
                display: flex;
                flex-direction: column; 
                flex-basis: 10px;
            }
            .remember-check{
               color: #ffffff;
               font-family: sans-serif;
               font-size: 13px;
               flex: 1.5;
               padding-right: 10px;
            }
            .sign-up{
                flex: 1;
                color: #ffffff;
               font-family: sans-serif;
               font-size: 13px;
               text-align: right;
               margin-right: 10px;
            }
            .links{
                display: flex;
                
            }
            .button-input{
                background: #ff3333;
                color: #ffffff;
            }
        </style>
    </head>
    <body>
        <div class="parent">
            <div class="child">
                <div class="container">
                    <form class="form_container" action="chpass.php" method="post">
                    <input class="input-child text-input" type="text" name="uname" placeholder="Username" required="true">
                    <input class="input-child password-input" type="password" name="opword" placeholder="Old Password" required="true">
                    <input class="input-child password-input" type="password" name="npword" placeholder="New Password" required="true">
                    <input class="input-child password-input" type="password" name="cnpword" placeholder="Confirm Password" required="true">
                    <input type="submit" class="input-child button-input" name="button_submit" value="Submit">
                    
                    </form>
                </div>   
            </div>
        </div>
        
        <?php
        if ($_SESSION["username"] == 0){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Username not found! Try Again!")';
            echo '</script>';
            $_SESSION["username"] = 1;
        }
        else if ($_SESSION["oldpass"] == 0){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Old password dont match! Try Again!")';
            echo '</script>';
            $_SESSION["oldpass"] = 1;
        }
        else if ($_SESSION["newpass"] == 0){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Old password and new password are the same! Try Again!")';
            echo '</script>';
            $_SESSION["newpass"] = 1;
        } 
        else if ($_SESSION["cnpass"] == 0){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("New passwords dont match! Try Again!")';
            echo '</script>';
            $_SESSION["cnpass"] = 1;
        }
        
        ?>   
    </body>
</html>
