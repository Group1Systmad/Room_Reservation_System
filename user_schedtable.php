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
    <link rel="stylesheet" href="mika/reservation.css" type="text/css">
<title>Reservations' List</title>
<style>
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
   window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
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
</script>
</head>
<body onload="startTime()">

<?php
if (isset($_SESSION["count"])){
    echo "Count: ".$_SESSION["count"];
    echo "Selected ".$_SESSION["selected"];
}else{
    echo "Session is not set";
}
?>
  
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
            <a class="hoverable" href="change_pass.php">Change Password</a> 
             <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
</div>
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>
        <li><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutususer.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li> <div class="selected"><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></div></li>
        <li><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></li>
        <li><div id="time" style="padding-top:180px; font-size: 18px; color:white;text-align: center"></div> </li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>
</div>

<div class="container">
        <table class="table">
            <tr class="headers" style="color:#00b3b3">
                <td>ReservationID</td>
                <td>RoomID</td>
                <td>EmployeeID</td>
                <td>TimeIn</td>
                <td>TimeOut</td>
                <td>Date</td>
                <td>Status</td>
            </tr>
            <?php
            include 'connect.php';
            $sql ="select * from tbl_sched order by id";
            $res = mysqli_query($con, $sql);
            $_SESSION["result_set"] = $res;
            while($row= mysqli_fetch_array($res))
            {
            ?>
            <form <?php echo ($_SESSION["count"]==2) ? 'method=\'post\' action=\'cell_edit.php\'' : '' ?>>
            <tr>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="reserv_id" id="reserv_id" value=<?php echo $row['id']; ?> readonly></td>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="room_id" id="room_id" value=<?php echo $row['room_id']; ?> readonly> </td>
                <td><input class="table_cell <?php echo 'cell'.$row['id']?>" name="emp_id" id="emp_id" value=<?php echo $row['emp_id']; ?>  readonly></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_in" value=<?php echo $row['time_in']; ?> readonly></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_out" value=<?php echo $row['time_out']; ?>  readonly></td>
                <td><input type="date" class="table_cell <?php echo 'cell'.$row['id']?>" name="date" value=<?php echo $row['date']; ?>  readonly"></td>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="status" id="status" value=<?php 
                    if ($row['Status'] == 1){
                        echo 'ACTIVE';
                    }
                    else if ($row['Status'] == 0) {
                        echo 'INACTIVE';
                    }
                
                ?>  readonly></td>
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
    <a onclick="return PopupCenter('addsched_user.php','Update Profile ','900','500'); "> <button class="btn btn-primary" style="margin-top: 45px">Add Reservation</button></a><br>

        <font size="4" face="arial"  color="#ff7a24">
            <?php
            include 'connect.php';

            $result = mysqli_query($con,"select * from tbl_sched");
            $rows = mysqli_num_rows($result);
            echo "<br>";
            echo "There are " . $rows . " record(s) in the table. ";
            mysqli_close($con);
            ?>
        </font>
</div>
</body>
</html>