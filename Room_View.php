<?php

session_start();

?>
<html>
    <head>
        <title>Room Overview</title>
    </head>
    <style>
        .table{
        width: 30%;
        margin: 0 auto;
    }
    .container{
        margin-top: 7%;
        text-align: center;
   
    }
    .cont{
             margin-right: 2%;
        margin-left: 10%;
    }
    .headers{
        text-align: center;
        font-size: medium;
    }
    td{
        font-size: small;
        text-align: center;
       
    }
    #delete,#edit{
        width: 50px;
    }
    #room_flr{
        width: 100px;
    }
    #room_bldg{
        width: 200px;
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
 </script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
    <body>
        <div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><div class="selected"><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></div></li>
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
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
</div>
        
        <div class="container cont">
            <table class="table">
                <tr class="headers" style="color:#00b3b3">
                    <td id="delete">Delete</td>
                    <td id="edit">Edit</td>
                    <td id="room_id">Room ID</td>
                    <td id="room_name">Room Name</td>
                    <td id="room_bldg">Room Building</td>
                    <td id="room_flr">Room Floor</td>
                    <td id="room_mac">MAC Address</td>
            </tr>
            </table>
        </div>
        
        
        
        
    </body>
    
    
</html>