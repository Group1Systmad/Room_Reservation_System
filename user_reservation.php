<?php
session_start();
?>
<html>
<head>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
<!--    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
<title>Your Reservation's List</title>
<style>
    .table{
        width: 30%;
        margin: 0 auto;
    }
    .container{
        margin-top: 5%;
        text-align: center;
        margin-right: 2%;
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
    #main-container{
        
        margin-left: 13%;
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

	function del()
	  {
	     var confirmdel = confirm("Confirm Delete?");

	     if (confirmdel==true)
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
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>
        <li><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutususer.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li> <div class="selected"><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></div></li>
        <li><a href="Room_View_User.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>
        <li><div id="time" style="padding-top:180px; font-size: 18px; color:white;text-align: center"></div> </li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>
       
    </ul>
</div>
    
    <div id="myAccountnav" class="accnav"  style="top:70px;">
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

    <div class="container" id="main-container">
        <table class="table">
            <tr class="headers" style="color:#00b3b3">
                <td>More Info</td>
                <td>Cancel</td>
                <td>Edit</td>
                <td>ReservationID</td>
                <td>RoomID</td>
                <td>TimeIn</td>
                <td>TimeOut</td>
                <td>Date</td>
                <td>UniqueCode</td>
            </tr>
            <?php
            include 'connect.php';
            $SQL ="SELECT * FROM accounts WHERE Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $SQL);
            $row1= mysqli_fetch_array($res);
            $sql1 ="select * from tbl_sched WHERE emp_id='".$row1['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $_SESSION["result_set"] = $res1;
            $_SESSION['counter'] = 0;
            while($row= mysqli_fetch_array($res1))
            {
            ?>
            <form <?php echo ($_SESSION["count"]==2) ? 'method=\'post\' action=\'cell_edit.php\'' : '' ?>>
            <tr>
                <td><a href="Reserve_Details_User.php?SID=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-info-sign"></span></a></td>
                <td align="center"><a onclick="return del()" href="delsched_user.php?SID=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
<!--                <td align="center"><a href="editsched.php?SID=--><?php //echo $row['id']; ?><!--"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
<!--                <td align="center"><a href="cell_edit.php?SID=<?php echo $row['id']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                        echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                        ?></a></td>
<!--                <td>--><?php //echo $row['id']; ?><!--</td>-->
                <td align="CENTER"><a href="editsched_user.php?SID=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="reserv_id" id="reserv_id" value=<?php echo $row['id']; ?> readonly></td>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="room_id" id="room_id" value=<?php echo $row['room_id']; ?> <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>> </td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_in" value="<?php echo $row['time_in']; ?>"  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_out" value=<?php echo $row['time_out']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="date" class="table_cell <?php echo 'cell'.$row['id']?>" name="date" value=<?php echo $row['date']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="text" class="table_cell <?php echo 'cell'.$row['id']?>" name="unique" id="unique" value=<?php echo $row['u_code']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
            </tr>
            </form>
            <?php //open of second php
            }//close of while
            mysqli_close($con);
            ?><!-- close of second php -->
        </table>
    <?php
    $_SESSION['urid'] = "";
    $_SESSION['utimein'] = "";
    $_SESSION['utimeout'] = "";
    $_SESSION['udate'] = "";
    $_SESSION['uerror'] = 'no';
    ?>
     <a href="addsched_user.php"> <button class="btn btn-primary" style="margin-top: 45px">Add Reservation</button></a><br>

        <font size="4" face="arial"  color="#ff7a24">
            <?php
            include 'connect.php';
            $SQL ="SELECT * FROM accounts WHERE Acc_Uname='".$_SESSION['username']."'";
            $res2 = mysqli_query($con, $SQL);
            $row2= mysqli_fetch_array($res2);
            $sql1 ="select * from tbl_sched WHERE emp_id='".$row2['Employee_ID']."'";
            $res3 = mysqli_query($con, $sql1);
            $rows = mysqli_num_rows($res3);
            echo "<br>";
            echo "There are " . $rows . " record(s) in the table. ";
            mysqli_close($con);
            ?>
        </font>
</div>
</body>
</html>