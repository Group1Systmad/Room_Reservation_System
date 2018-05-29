<?php
session_start();
$rid = $_GET['SID'];
if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}

?>
<html>
    <head>
        <title>View Room Details</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
     <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/aboutus.css" type="text/css">

<style>
    .container{
        width: 85%;
        background: #fff;
        margin: 0 auto;
        margin-top: 50px;
        margin-left: 10%;
        padding: 5px;
        border-radius: 10px;
    }

    .child{
        width: 50%;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
        display: flex;
        flex-flow: column;
    }
    .btn{
        width: 100%;
    }
    label{
        color: #fff;
    }
    #popup{
        margin: 0;
    }
     * {box-sizing: border-box;}
    
    .portrait{
                margin: 0 auto;
                text-align: center;
                width: 100%;
                position: absolute;
                padding-bottom: 50px;
            }
            
            .imgcont{
                position: relative;
                margin: auto;
                padding-top: 90px;
                width:200px;
                }
            
            .cover{
                width: 100%;
                height: 150px;
                background: #1b6d85;
                
            }
            .cover-container{
                position: relative;
                margin-bottom: 100px; 
                margin-top: -20px;
            }
            .user-identity{
                text-align: center;
            }
            .userfullname{
                text-transform: uppercase;
                font-weight: 500;
            }
            .half{
                
                background: #f7f7f7;
                padding: 20px;
                border: 2px solid white;
            }
            .table{
                margin-top: 20px;
                border: 1px solid #e4e4e4;
            }
            .table td{
                background: #fff;
            }
            .change-pass-link{
                text-align: right;
                margin-left: 50px;
            }
            #account_type{
                text-transform: capitalize;
            }
            .overlay {
            position:absolute;
            width: 200px;
            border-radius: 0 0 200px 200px;
            height: 100px;
            bottom:0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            color: #f1f1f1; 
            padding:20px;
            transition: .5s ease;
            opacity:0;
            color: white;
            font-size: 15px;
            padding-top: 50px;
            }

            .imgcont:hover .overlay {
            opacity: 1;
}
</style>
<script type="text/javascript">
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
 </script>
</head>
<body onload="startTime()">
    
    
    <div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><div class="selected"><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></div></li>
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
            <a class="hoverable" href="user_account.php">Account Info</a> 
            <a  class="hoverable" href="change_pass.php">Change Password</a> 
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" <?php 
                $_SESSION["login"] = 'logout'; ?> href="login_page.php">Logout</a></div>
            </div>
</div>
        <?php
        //code here to get data from database using $rid;
        include 'connect.php';
        $SQL = "SELECT * FROM tbl_roomlist WHERE room_id='$rid'";
        $res = mysqli_query($con, $SQL);
        $row = mysqli_fetch_array($res);
        
        ?>
    
    
      <div class="container">
            <div class="row">
                <div class="col-md-6 half">
                Location
                <table class="table">
                    <tr>
                        <td>Room Name:</td>
<!--                        replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['room_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Room Bldg:</td>
                        <!--  replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['room_bldg']; ?></td>
                    </tr>
                    <tr>
                         <td>Room Floor</td>
                         <!--  replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['room_floor']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 half">
                Features
                <table class="table">
                    <tr>
                        <td>Amenities</td>
                        <!--  replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['Amenities']; ?></td>
                    </tr>
                </table>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 half">
                   Accommodation
                    <table class="table">
                        <tr>
                        <td>Max Pax</td>
                        <!-- replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['Pax']; ?></td>
                        </tr>
                    </table>
                    
                </div>
               
            </div>
        </div>
    
    
    
    
</body>
</html>