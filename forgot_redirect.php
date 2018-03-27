<html>
    <head>
        <title>We've sent you an email!</title>
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
                <h1 class="text">We've sent you an email!</h1>
                <div class="container">
                    
                    <div class="form_container">
                        <p class="text">Please check your email for the password.</p>
                        <a href = "login_page.php" class="button btn btn-primary"  name="login_redirect">Login</a>
                        <a href = "forgotpassword.php" class="button btn btn-danger"  name="resend_button">Resend  </a>
                    </div>
                </div>   
            </div>
        </div>
    </body>
</html>