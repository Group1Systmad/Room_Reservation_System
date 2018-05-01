<?php
session_start();
?>
<html>
<head>
    <title>Add Records</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
       <link rel="stylesheet" href="mika/about.css" type="text/css">
     <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
    <style>
        .container{
            width: 100%;
            background: #27698d;
            margin: 0 auto;
            margin-top: 10%;
            padding: 50px;
            border-radius: 10px;
        }
        .btn-primary{
            color: #27698d;
            background-color: #fff;
        }
        label{
            color: #fff;
            font-size: small;
        }
        #popup{
            margin: 0;
        }
    </style>
</head>
<body>
    
    <div class="container" id="popup">
        <form name="addemp" method="POST" action="saverec.php">
            <div class="form-group row">
                <div class="col-md-2 id_input">
                    <label for="txtID">ID Number:</label>
                    <input class="form-control"  TYPE="text" NAME="txtID" id="txtID">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="email_input">Email</label>
                    <INPUT class="form-control" id="email_input" TYPE="email" NAME="txtEmail" ID="txtEmail">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="txtUser">Username:</label>
                    <input class="form-control"  TYPE="text" NAME="txtUser" id="txtUser">
                </div>
                <div class="col-md-3">
                    <label for="txtPass">Password:</label>
                    <input class="form-control"  TYPE="password" NAME="txtPass" id="txtPass">
                </div>
                <div class="col-md-3">
                    <label for="txtPass">Re-enter Password:</label>
                    <input class="form-control"  TYPE="password" NAME="txtRepass" id="txtRepass">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="txtLN">Last Name</label>
                    <input class="form-control" TYPE="text" name="txtLN" id="txtLN">
                </div>
                <div class="col-md-6">
                    <label for="txtFN">First Name</label>
                    <input class="form-control" type="text" name="txtFN" id="txtFN">
                </div>
                <div class="col-md-2">
                    <label for="age_input">Age</label>
                    <INPUT id="age_input" class="form-control" TYPE="text" NAME="txtAge" ID="txtAge">
                </div>
                <div class="col-md-2">
                    <label for="gender_input">Gender</label>
                    <SELECT class="form-control" id="gender" NAME="gender">
                        <OPTION>Male
                        <OPTION>Female
                    </SELECT>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="input_address">Address</label>
                    <INPUT class="form-control" TYPE="text" NAME="txtAddress" ID="txtAddress">
                </div>
                <div class="col-md-4">
                    <label for="contact_number">Contact Number</label>
                    <input class="form-control" type="text" name="txtContactNumber" id="contact_number">
                </div>
                <div class="col-md-4">
                    <label for="department_input">Department</label>
                    <INPUT class="form-control" id="department_input" TYPE="text" NAME="txtDepartment" ID="txtDepartment">
                </div>
            </div>
            <INPUT class="btn btn-primary" TYPE="Submit" VALUE="Save">
            <INPUT class="btn btn-danger" TYPE="Reset" VALUE="Clear">
        </form>
    </div>



</body>
</html>

