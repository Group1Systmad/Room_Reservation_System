<?php
session_start();
?>
<?php
    include 'connect.php';
    $sid = $_GET['SID'];
    
    $SQL = "SELECT tbl_sched.id,tbl_sched.room_id,tbl_sched.emp_id,tbl_sched.time_in,tbl_sched.time_out,tbl_sched.date,
            tbl_sched.u_code,tbl_sched.Status,tbl_roomlist.room_name,tbl_roomlist.room_bldg,tbl_roomlist.room_floor,
            tbl_roomlist.Amenities,tbl_roomlist.Pax,tbl_roomlist.Room_Status,employee.Employee_ID,employee.Emp_FN,
            employee.Emp_LN,employee.Emp_Department,employee.Emp_CNumber,employee.Emp_Email 
            FROM tbl_sched,tbl_roomlist,employee WHERE tbl_sched.room_id = tbl_roomlist.room_id
            AND tbl_sched.emp_id = employee.Employee_ID AND tbl_sched.id = '$sid'";
    
    $result = mysqli_query($con, $SQL);
    
    while ($row = mysqli_fetch_assoc($result)){
        $reservation_id = $row['id'];
        $room_id = $row['room_id'];
        $emp_id = $row['emp_id'];
        $time_in = $row['time_in'];
        $time_out = $row['time_out'];
        $date = $row['date'];
        $u_code = $row['u_code'];
        $reservation_status = $row['Status'];
        $room_name = $row['room_name'];
        $room_bldg = $row['room_bldg'];
        $room_floor = $row['room_floor'];
        $amenities = $row['Amenities'];
        $pax = $row['Pax'];
        $room_status = $row['Room_Status'];
        $emp_fn = $row['Emp_FN'];
        $emp_ln = $row['Emp_LN'];
        $emp_dept = $row['Emp_Department'];
        $emp_cnumber = $row['Emp_CNumber'];
        $emp_email = $row['Emp_Email'];
    }
?>
<html>
    <head>
        <title>Reservation Details</title>
      <style>
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
            #cancel_panel{
                text-align: center;
                background-color: #1b6d85;
            }
           #cancel_header{
                color: #fff;
                text-align: center;
            }
        </style>
           <script type="text/javascript">
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var n= today.getMonth();
    var o= today.getDate();
    var p= today.getFullYear();
    if (h>=13){h= h-12; }
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    n = n+1;
    n = checkTime(n);
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
//LOG OUT FUNCTION
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
//END OF LOG OUT FUNCTION
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
    <body onload="startTime()">
        <div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><div class="selected"><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></div></li>
        <li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>
       <li><div id="time" style="padding-top:20px; font-size: 18px; color:white;text-align: center"></div></li>
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
            $_SESSION['employee_num'] = $row['Employee_ID'];
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
        
       <div class="container">
            <div class="row">
                <div class="col-md-6 half">
                Reservation Details
                <table class="table">
                    <tr>
                        <td>Reserved Room: </td>
                        <td><?php echo $room_name?></td>
                    </tr>
                    <tr>
                        <td>Starting Time:</td>
                        <td><?php echo $time_in?></td>
                    </tr>
                    <tr>
                         <td>End Time:</td>
                        <td><?php echo $time_out?></td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td><?php echo $date?></td>
                    </tr>
                    <tr>
                        <td>Unique Code:</td>
                        <td><?php echo $u_code?></td>
                    </tr>
                      <tr>
                        <td>Status :</td>
                        <td><?php 
                            if($reservation_status == 0){
                                echo "INACTIVE";
                            }
                            else{
                                echo "ACTIVE";
                            }
                                
                        ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 half">
                Reservee Details
                <table class="table">
                    <tr>
                        <td>Employee Number</td>
                        <td><?php echo $emp_id?></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $emp_fn?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $emp_ln?></td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td><?php echo $emp_dept?></td>
                    </tr>
                </table>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 half">
                   Room Details
                    <table class="table">
                        <tr>
                            <td>Room Number</td>
                            <td><?php echo $room_id?></td>
                        </tr>
                        <tr>
                            <td>Room Building</td>
                            <td><?php echo $room_bldg?></td>
                        </tr>
                        <tr>
                            <td>Room Floor</td>
                            <td id="account_type"><?php echo $room_floor?></td>
                        </tr>
                        <tr>
                            <td>Amenities</td>
                            <td id="account_type"><?php echo $amenities?></td>
                        </tr>
                        <tr>
                            <td>PAX</td>
                            <td id="account_type"><?php echo $pax?></td>
                        </tr>
                    </table>
                </div>
                 <?php 
                    if($reservation_status == 1){ ?>
                <div class="col-md-6 half" id="cancel_panel">
<!--                    Cancel button must appear if the reservation status is Active-->
<!--                    Delete Alert Pop up before deleting-->
                   <h2 id="cancel_header">Do you want to cancel your reservation?</h2>
                    <a href="delsched.php?SID=<?php echo $sid;?>"><button class="btn btn-danger">Cancel Reservation</button></a>
                </div>
                    <?php } ?>
                
            </div>
         
        </div>
        
        
        
    </body>
</html>