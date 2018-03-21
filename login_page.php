<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Practice</title>
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
                    <img src="man.png" class="avatar">
                    <form class="form_container" action="verifylogin.php" method="post">
                    <input class="input-child text-input" type="text" name="uname" placeholder="Username">
                    <input class="input-child password-input" type="password" name="pword" placeholder="Password">
                    <input type="submit" class="input-child button-input" name="button_login" value="Log In">
                    <div class="links">
                        <label for="check1" class="remember-check"><input type="checkbox" name="check_box" id="check1">Remember me</label>
                        <a href="login_page.php" class="sign-up">Sign up</a>
                    </div>
                    </form>
                </div>   
            </div>
        </div>

    <?php
        if ($_SESSION["incorrect"]==true){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Login failed. Please try again")';
            echo '</script>';
            $_SESSION["incorrect"] = false;
        }
    ?>
    </body>
</html>
