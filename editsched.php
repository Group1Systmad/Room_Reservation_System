<?php
  session_start();
  if ($_SESSION['counter'] == 0){
  $id = $_GET['SID'];
  $_SESSION['id'] = $id;
  }
  else {
  $id = $_SESSION['id'];
  }
  if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}
  
?>
<html>
    <head>
        <title>Edit Rooms</title>
        <style>
    .cont{
         width: 40%;
         height: 95%;
            background: #27698d;
            margin-top: 5%;
            margin: auto;
            padding: 30px 30px 0 50px;
            border-radius: 10px;
    }
    .child{
        width: 85%;
        margin: 0 auto;
        margin-top: 5%;
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
 <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
 
    </head>
    <body onload="startTime()" background="bg.jpg">
        <div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><div class="selected"><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></div></li>
        <li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>
        <li><div id="time" style="padding-top:20px; font-size: 18px; color:white; text-align: center"></div></li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div></li>
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
        <?php
        include 'connect.php';
        $SQL = "SELECT * FROM tbl_sched WHERE id = '$id'";
        $result = mysqli_query($con,$SQL); //rs.open sql,con
        $row = mysqli_fetch_assoc($result);
        if ($_SESSION['counter'] == 0){
            $rid = $row['room_id'];
            $eid = $row['emp_id'];
            $time_in = $row['time_in'];
            $time_out = $row['time_out'];
            $date = $row['date'];
            $ucode = $row['u_code'];
            $_SESSION['o_rid'] = $rid;
            $_SESSION['o_eid'] = $eid;
            $_SESSION['o_timein'] = $time_in;
            $_SESSION['o_timeout'] = $time_out;
            $_SESSION['o_date'] = $date;
            $_SESSION['o_code'] = $ucode;
            $_SESSION['counter'] = 1;
        }
        else if ($_SESSION['counter'] == 1){
            $rid = $_SESSION['rid'];
            $eid = $_SESSION['eid'];
            $time_in = $_SESSION['timein'];
            $time_out = $_SESSION['timeout'];
            $date = $_SESSION['date'];
            $ucode = $_SESSION['ucode'];
          }
          
          $_SESSION['id'] = $id;
          
          $_SESSION['ucode'] = $ucode;
          
          ?>
        <div class="title" style="color:#fff; font-size: 40px; padding-bottom: 0; padding-right: 20px;  font-family: Impact; margin-left: 390px"> Edit Reservation </div> 
        <div class="cont">
        <form class="form_container" name="editsched" method="post">
            
            <div class="child">    
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Reservation ID</label>
                    <input class="form-control" type="text" name="txteid" value="<?php echo $id;?>" id="txtid"  readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                   <label for="txtrid">Room Number</label>
                   <?php 
                   if ($_SESSION['error'] != 'avail'){ ?>
                    <SELECT class="form-control" id="txtrid" NAME="txtrid">
                        <?php
                        include 'connect.php';
                        $SQL = "SELECT * FROM tbl_roomlist";
                        $res = mysqli_query($con, $SQL);
                        $i = -1;
                        while($row = mysqli_fetch_array($res))
                        {
                            $i++;
                            $col[$i]['room_id']=$row['room_id'];

                        }       
                        for ($j=0;$j<=$i;$j++){
                        ?>
                        <OPTION><?php echo $col[$j]['room_id'];
                        }
                            ?>
                        
                    </SELECT>
                    <?php } 
                    else if ($_SESSION['error'] == 'avail') { ?>
                    <input class="form-control" type="text" name="txtrid" value="<?php echo $rid;?>" id="txtrid" readonly>
                    
                    <?php
                    }
                    ?>
                    
                </div>
                <div class="col-md-6">
<!--                    <a href = "roomdetails.php"><button class="btn btn-primary">Room Details</button>></a>-->
                    <input class="btn btn-primary" style="background-color: #ff7a24" type="submit" value="Room Details" formaction="roomdetails.php">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txteid">Employee ID</label>
                    <input class="form-control" type="text" name="txteid" value="<?php echo $eid;?>" id="txteid" placeholder="Employee ID" required="true" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="txtti">Time In</label>
                    <input class="form-control" type="time" name="txtti" value="<?php echo $time_in;?>" id="txtti">
                </div>
                <div class="col-md-6">
                    <label for="txtto">Time Out</label>
                    <input class="form-control" type="time" name="txtto" value="<?php echo $time_out;?>" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtd">Date</label>
                    <input class="form-control" type="date" name="txtd" value="<?php echo $date;?>" id="txtd">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtuc">Unique Code</label>
                    <input class="form-control" id="txtuc" name="txtuc" value=<?php echo $ucode;?>  readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save" formaction="checkavail_edit.php">
                </div>   
                <div class="col-md-6">
                    <input class="btn btn-danger" type="reset" value="Clear" id=btnReset">
                </div>  
                
                 </div>
<!--            <div class="row">
              <div class="col-md-12">
                  <a href="schedtable.php"><button class="btn btn-primary">Back</button></a>
              </div>
            </div>-->
    </div>
        
             <?php
                if ($_SESSION['error']== 'wrongdate'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of date.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'wrongtime'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of time.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'wrongrange'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room is not available at that time. Check Rooms for details.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'notavail'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room not available. Input another room or time and date")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'notimedate'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Input valid time or date.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                ?>
        </form> 
    </body>
</html>



