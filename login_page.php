<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
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
                border-radius: 100%;
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
              
               padding-right: 10px;
               text-align: left;
            }
            .sign-up{
                   color: #ffffff;
               font-family: sans-serif;
               font-size: 13px;
               flex: 1.5;
               padding-right: 8px;
               text-align: right;
            }
            .forgot-pass{
                flex: 1;
                color: #ffffff;
               font-family: sans-serif;
               font-size: 13px;
               text-align: center;
               margin-right: 10px;
            }
            .links{
                display: flex;
                margin-bottom: 5px;
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
                    <div class="emblem"><img src="logo3.png" class="avatar"></div>
                    <form class="form_container" action="verifylogin.php" method="post">
                    <input class="input-child text-input" type="text" name="uname" placeholder="Username" required = "true">
                    <input class="input-child password-input" type="password" name="pword" placeholder="Password" required = "true">
                    <div class="links">
                        <label for="check1" class="remember-check"><input type="checkbox" name="check_box" id="check1">Remember me</label>
                    </div>
                    <input type="submit" class="input-child button-input" name="button_login" value="Log In">
                    <div class = "links">
                        <a href="forgotpassword.php" name="forgotpassword" class = "forgot-pass">Forgot Password</a>
                    </div>
                    </form>
                </div>   
            </div>
        </div>

    <?php
        if ($_SESSION["login"]=='failed'){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Login failed. Incorrent username/password entered.Please try again")';
            echo '</script>';
            $_SESSION["login"] = 'no';
        }
        else if ($_SESSION["login"]=='logout'){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Log Out Successful!")';
            echo '</script>';
            $_SESSION["login"] = 'no';
            session_unset();
            session_destroy();
        }
        if ($_SESSION['changed'] == 1){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Password Changed Successfully!")';
            echo '</script>';
        }
        $_SESSION["login"] = 'no';
        $_SESSION['changed'] = 0;
    ?>
    </body>
</html>
