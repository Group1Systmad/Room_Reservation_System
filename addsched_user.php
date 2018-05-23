<?php
session_start();

?>
<html><head><title>Add New Schedule</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
     <link rel="stylesheet" href="mika/about.css" type="text/css">
     
<style>
    .container{
        width: 40%;
            height: 91%;
            background: #0C67A6;
            margin-top: 5%;
            margin: auto;
            padding: 30px 30px 60px 60px;
            border-radius: 10px;
    }

    .child{
        width: 100%;
        margin: 0 auto;
        margin-top: 3%;
        padding: 5px;
        display: flex;
        flex-flow: column;
         padding-top: 5px;
    }
    .btn{
        width: 100%;
    }
    label{
        color: #fff;
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

     window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
    </script>
</head>
<body onload="startTime()" background="bg.jpg">
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

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
    
    <div class="title" style="color:#fff; font-size: 40px; padding-bottom: 0; padding-right: 20px;  font-family: Impact; margin-left: 390px"> Create Reservation </div>
          
<div class="container">
        <form class="form_container" name="addsched" method="post">
            <div class="child">    
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
                    <SELECT class="form-control" id="txtrid" NAME="txtrid" disabled>
                        
                        <OPTION><?php echo $_SESSION['rid'];
                        
                            ?>
                        
                    </SELECT>    
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
                    <?php
                    include 'connect.php';
                    $SQL ="SELECT * FROM accounts WHERE Acc_Uname='".$_SESSION['username']."'";
                    $res = mysqli_query($con, $SQL);
                    $row= mysqli_fetch_array($res);
                    ?>
                    <label for="txteid">Employee ID</label>
                    <input class="form-control" id="txteid" name="txteid" value=<?php echo $row['Employee_ID'];?>  readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="txtti">Time In</label>
                     <input class="form-control" type="time" name="txtti" value="<?php echo $_SESSION['utimein'];?>" id="txtti">
                </div>
                <div class="col-md-6">
                    <label for="txtto">Time Out</label>
                   <input class="form-control" type="time" name="txtto" value="<?php echo $_SESSION['utimeout'];?>" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtd">Date</label>
                    <input class="form-control" type="date" name="txtd" value="<?php echo $_SESSION['udate'];?>" id="txtd">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <?php
                        $random = rand(10000,99999); 
                    ?>
                    <label for="txtuc">Unique Code</label>
                    <input class="form-control" id="txtuc" name="txtuc" value=<?php echo $random;?>  readonly>
                    
                </div>
            </div>
            <div class="form-group row">
                <?php 
                if ($_SESSION['uerror'] != 'avail'){ ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Check Availability" formaction="checkavail_user.php">
                <?php }
                else if ($_SESSION['uerror'] == 'avail'){
                
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room Available.")';
                echo '</script>';  
                ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save" formaction="add_user.php">
                <?php }?>
                </div>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="reset" value="Clear">
                </div>
            </div>
            </div>
        </form>

</div>
        <?php
            if ($_SESSION['uerror']== 'wrongdate'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of date.")';
                echo '</script>'; 
                $_SESSION['uerror']='no';
                }
            else if ($_SESSION['uerror']== 'wrongtime'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of time.")';
                echo '</script>'; 
                $_SESSION['uerror']='no';
                }
            else if ($_SESSION['uerror']== 'notavail'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room not available. Input another room or time and date")';
                echo '</script>'; 
                $_SESSION['uerror']='no';
                }
                ?>

</body>
</html>