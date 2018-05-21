<?php
session_start();
if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}
?>
?>
<html>
<head>
    <title>Add Records</title>
    <style>
        .container{
            width: 50%;
            background: #27698d;
            margin: 0 auto;
            margin-top: 10%;
            padding: 5px;
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
    <SCRIPT TYPE="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var n= today.getMonth();
    var o= today.getDate();
    if (h>12){h= h-12; }
    h = checkTime(h);
    m = checkTime(m);
    n = n+1;
    n = checkTime(n);
    o = checkTime(o);
     document.getElementById('time').innerHTML =
     h + ":" + m 
     document.getElementById('date').innerHTML =
     n + "/" + o 
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}	
    function Del()
	  {
	     var confirmDel = confirm("Are you sure you want to delete this record?");

	     if (confirmDel==true)//the user pressed the ok button
	     {
	     	return true;
	     }
	     else
	     {
	     	return false;
	     }
	  }
          function logout()
        {
	     var confirmdel = confirm("Confirm Log Out?");

	     if (confirmdel==true)
	     {
	     	return true;
	     }
	     else
	     {
	     	return false;
	     }
        }
        
        function openaccNav() {
             document.getElementById("myAccountnav").style.width = "250px";
             //document.getElementById("myAccountnav").style.border = "1px solid black";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementById("myAccountnav").style.border = "none";
}

function PopupCenter(url, title, w, h) {  
    // Fixes dual-screen position                         Most browsers      Firefox  
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;  
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;  
              
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;  
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;  
              
    var left = ((width / 2) - (w / 2)) + dualScreenLeft;  
    var top = ((height / 2) - (h / 2)) + dualScreenTop;  
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);  
  
    // Puts focus on the newWindow  
    if (window.focus) {  
        newWindow.focus();  
    }  
}  
</SCRIPT>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
    
</head>
<body onload="startTime()">
    <div id="myAccountnav" class="accnav" style="top:70px;">
  <a href="javascript:void(0)" class="closebtn hoverable" onclick="closeaccNav()">&times;</a>
            <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            ?>
           <div class="center"> <img src= "<?php  if (empty($row1['Emp_Photo'])){ echo "Male User_96px.png";} else {echo $row1['Emp_Photo'];}?>" style="border-radius: 100%; max-height: 90px;">
            <div class="name"> <?php echo $row1['Emp_FN']; ?> <?php echo $row1['Emp_LN']; ?> </div>
            <div class="id"> ID Number: <?php echo $row['Employee_ID']; ?> </div>
            <hr>
            <a class="hoverable" href="admin_account.php">Account Info</a> 
            <a class="hoverable" href="change_pass.php">Change Password</a> 
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" <?php 
                $_SESSION["login"] = 'logout'; ?> href="login_page.php">Logout</a></div>
            </div>
</div>
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><div class="selected"><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></div></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>
        <li><div id="time" style="padding-top:180px; font-size: 18px; color:white; text-align: center"></div> </li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>
       
    </ul>
</div>
    
    <div class="container">
        <form name="addemp" method="POST" action="saverec.php">
            <div class="form-group row">
                <div class="col-md-2 id_input">
                    <label for="txtID">ID Number:</label>
                    <input class="form-control"  TYPE="text" NAME="txtID" id="txtID" required="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="email_input">Email</label>
                    <INPUT class="form-control" id="email_input" TYPE="email" NAME="txtEmail" ID="txtEmail" required="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="txtUser">Username:</label>
                    <input class="form-control"  TYPE="text" NAME="txtUser" id="txtUser" required="true">
                </div>
                <div class="col-md-3">
                    <label for="txtPass">Password:</label>
                    <input class="form-control"  TYPE="password" NAME="txtPass" id="txtPass" required="true">
                </div>
                <div class="col-md-3">
                    <label for="txtPass">Re-enter Password:</label>
                    <input class="form-control"  TYPE="password" NAME="txtRepass" id="txtRepass" required="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-2">
                    <label for="txtLN">Last Name</label>
                    <input class="form-control" TYPE="text" name="txtLN" id="txtLN" required="true">
                </div>
                <div class="col-md-6">
                    <label for="txtFN">First Name</label>
                    <input class="form-control" type="text" name="txtFN" id="txtFN" required="true">
                </div>
                <div class="col-md-2">
                    <label for="age_input">Age</label>
                    <INPUT id="age_input" class="form-control" TYPE="text" NAME="txtAge" ID="txtAge" required="true">
                </div>
                <div class="col-md-2">
                    <label for="gender_input">Gender</label>
                    <SELECT class="form-control" id="gender" NAME="gender">
                        <OPTION>Male
                        <OPTION>Female
                    </SELECT>
                </div>
                <div class="col-md-2">
                    <label for="type_input">Account Type</label>
                    <SELECT class="form-control" id="type" NAME="type">
                        <OPTION>User
                        <OPTION>Admin
                    </SELECT>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="input_address">Address</label>
                    <INPUT class="form-control" TYPE="text" NAME="txtAddress" ID="txtAddress" required="true">
                </div>
                <div class="col-md-4">
                    <label for="contact_number">Contact Number</label>
                    <input class="form-control" type="text" name="txtContactNumber" id="contact_number" required="true">
                </div>
                <div class="col-md-4">
                    <label for="department_input">Department</label>
                    <INPUT class="form-control" id="department_input" TYPE="text" NAME="txtDepartment" ID="txtDepartment" required="true">
                </div>
            </div>
            <INPUT class="btn btn-primary" TYPE="Submit" VALUE="Save">
            <INPUT class="btn btn-danger" TYPE="Reset" VALUE="Clear">
        </form>
    </div>



</body>
</html>

