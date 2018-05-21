<?php
  session_start();
        $rid = $_GET['SID'];
  if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}

  include 'connect.php';

   $SQL = "SELECT * FROM tbl_roomlist WHERE room_id = '$rid'";
   $result = mysqli_query($con,$SQL); //rs.open sql,con

   

   while ($row = mysqli_fetch_assoc($result))
     {
     	$rname = $row["room_name"];
     	$rbldg = $row["room_bldg"];
     	$rfloor = $row["room_floor"];
     	$macaddr = $row["mac_address"];
        $timeopen = $row["timeframe_in"];
        $timeclose = $row["timeframe_out"];
     }
?>
<html>
    <head>
        <title>Edit Rooms</title>
        <style>
       .cont{
        width: 50%;
        background: #27698d;
        margin: 0 auto;
        margin-top: 10%;
        padding: 5px;
        border-radius: 10px;
        }
    input{
        float: right;   
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
    #btnupdate{
        background-color: #FFF;
        color: #337ab7;
    }
    label{
        color: #fff;
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
 
    </head>
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
             <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" <?php 
                $_SESSION["login"] = 'logout'; ?> href="login_page.php">Logout</a></div>
            </div>
</div>
        <div class="cont">
            <form "form-container" name="edit_room" method="POST" action="update_rooms.php">
                <div class="child">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room ID</label>
                            <input TYPE="text" NAME="roomid" ID="roomid" VALUE="<?php echo $rid; ?>" required='true'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room Name</label>
                            <input TYPE="text" NAME="roomname" ID="roomname" VALUE="<?php echo $rname; ?>" required='true'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room Building</label>
                            <input TYPE="text" NAME="roombldg" ID="roombldg" VALUE="<?php echo $rbldg; ?>"  required='true'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room Floor</label>
                            <input TYPE="text" NAME="roomfloor" ID="roomfloor" VALUE="<?php echo $rfloor; ?>"  required='true'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">MAC Address</label>
                            <input TYPE="text" NAME="macaddr" ID="macaddr" VALUE="<?php echo $macaddr; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Opening Time</label>
                            <input TYPE="time" NAME="timeframe_in" ID="timeframe_in" VALUE="<?php echo $time_open; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Closing Time</label>
                            <input TYPE="time" NAME="timeframe_out" ID="timeframe_out" VALUE="<?php echo $time_close; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input class="btn btn-primary" id="btnupdate" TYPE="Submit" VALUE="Update">
                          <input TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $rid; ?>">
                        </div>
                    </div>
                </div>
            </form>
            
            
<!--            <center>
<form NAME="edit_room" METHOD="POST" ACTION="update_rooms.php">
<table BORDER=1 WIDTH=25%>
	<tr>
		<td COLSPAN=2 ALIGN="CENTER">Edit Record</td>
	</tr>

	<tr>
		<td>Room ID:</td>
		<td><input TYPE="text" NAME="roomid" ID="roomid" VALUE="<?php echo $rid; ?>"></td>
	</tr>
        <tr>
		<td>Room Name:</td>
		<td><input TYPE="text" NAME="roomname" ID="roomname" VALUE="<?php echo $rname; ?>"></td>
	</tr>
        <tr>
		<td>Room Building:</td>
		<td><input TYPE="text" NAME="roombldg" ID="roombldg" VALUE="<?php echo $rbldg; ?>"></td>
	</tr>
        <tr>
		<td>Room Floor:</td>
		<td><input TYPE="text" NAME="roomfloor" ID="roomfloor" VALUE="<?php echo $rfloor; ?>"></td>
	</tr>
        <tr>
		<td>MAC Address:</td>
		<td><input TYPE="text" NAME="macaddr" ID="macaddr" VALUE="<?php echo $macaddr; ?>"></td>
	</tr>
	<tr>
		<td COLSPAN=2 ALIGN="CENTER">
		<input TYPE="Submit" VALUE="Update">
		<input TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $rid; ?>">
		</td>
	</tr>

</table>
</form>
</center>
        </div>-->
        
        
    </body>
</html>



