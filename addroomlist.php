<?php
session_start();
if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}
?>
<html>
<head>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
<!--    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
<title>Add New Room</title>
<style>
    .table{
        width: 60%;
        margin: 0 auto;
    }
    .container{
            width: 40%;
            height: 90%;
            background: #27698d;
            margin-top: 0;
            margin: auto;
            padding: 30px 30px 0 50px;
            border-radius: 10px;
    }
    .child{
        width: 90%;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px auto;
        display: flex;
        flex-flow: column;
    }
    .btn{
        width: 100%;
    }
    label{
        color: #fff;
    }
    .headers{
        text-align: center;
        font-size: medium;
    }
    td{
        font-size: small;
    }
    .glyphicon-remove{
        color: #ff572d;
        font-size: medium;
    }
    .glyphicon-pencil,.glyphicon-floppy-disk{
        font-size: medium;
    }
    .table_cell{
        background: transparent;
        border: none;
        text-align: center;
    }
    <?php echo ($_SESSION["count"]==2) ? $_SESSION["classname"].'{background:white;border:1px solid;}' : ''?>
    #room_id{
        width: 50px;
    }
    #emp_id{
        width: 80px;
    }
    .save{
        padding: 0 0;

    }
</style>
<script type="text/javascript">
	
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
             document.getElementById("myAccountnav").style.border = "1px solid black";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementById("myAccountnav").style.border = "none";
}

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
</script>
</head>
<body onload="startTime()" background="bg.jpg">
        <div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><div class="selected"><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></div></li>
          <li><div id="time" style="padding-top:20px; font-size: 18px; color:white; text-align: center"></div> </li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>
    </ul>
    </div>
       
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
            <a  class="hoverable" href="change_pass.php">Change Password</a> 
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" <?php 
                $_SESSION["login"] = 'logout'; ?> href="login_page.php">Logout</a></div>
            </div>
</div>
        

 <div class="title" style="color:#fff; font-size: 40px; padding-bottom: 0; padding-right: 20px;  font-family: Impact; margin-left: 390px"> Add Room </div>
<div class="container">
        <form class="form_container" name="addroomlist" method="post" action="addroom.php">
            <div class="child">    
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="txtrid">Room ID:</label>
                    <input class="form-control" type="text" name="txtrid" id="txtrid" placeholder="Room Number">
                </div>
                        <div class="col-md-8">
                            <label for="roomid">Room Name</label>
                            <input class="form-control" TYPE="text" NAME="roomname" ID="roomname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="roomid">Room Floor</label>
                            <input class="form-control" TYPE="text" NAME="roomfloor" ID="roomfloor">
                        </div>
                        <div class="col-md-8">
                            <label for="roomid">Room Building</label>
                            <input class="form-control" TYPE="text" NAME="roombldg" ID="roombldg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">MAC Address</label>
                            <input class="form-control" TYPE="text" NAME="macaddr" ID="macaddr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="roomid">Opening Time</label>
                            <input class="form-control" TYPE="time" NAME="timeframe_in" ID="timeframe_in">
                        </div>
                        <div class="col-md-6">
                            <label for="roomid">Closing Time</label>
                            <input class="form-control" TYPE="time" NAME="timeframe_out" ID="timeframe_out">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                          <input TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $rid; ?>">
                        </div>
                    </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <?php
                    $_SESSION['type'] = 'admin';
                    ?>
                    <p style="padding-bottom: 30px"> </p>
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
                   <p style="padding-bottom: 30px"> </p>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="submit" value="Cancel">
                </div>
                
            </div>
        </form>

</div> 
            
</div> 
            <?php
        if ($_SESSION['same']==true){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Room already exists. Input another room ID")';
            echo '</script>';
            $_SESSION["same"] = false;
        }
    ?>
</body>
</html>