<?php
session_start();

?>
<html><head><title>Add New Schedule</title>
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
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
     <link rel="stylesheet" href="mika/about.css" type="text/css">
     
<style>
    .container{
        width: 50%;
        background: #000033;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
        border-radius: 10px;
        margin-top: 2%;
        height: 93%;
    }

    .child{
        width: 50%;
        margin: 0 auto;
        margin-top: 5%;
        padding: 20px;
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
</head>
<body>
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

?>
  
<div id="myAccountnav" class="accnav" style="top:70px;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeaccNav()">&times;</a>
            <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            ?>
            <div class="center"> <img src= "<?php  if (empty($row1['profile'])){ echo "Male User_96px.png";} else {echo $row1['profile'];}?>"style="border-radius: 100%; max-height: 90px;">
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
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>
        <li><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></li>
    
    </ul>
</div>

<div class="container">
        <form class="form_container" name="addsched" method="post">
            <div class="child">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtrid">Room Number</label>
                    <SELECT class="form-control" id="txtrid" NAME="txtrid">
                        <?php
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
                <div class="col-md-12">
                    <label for="txtti">Time In</label>
                     <input class="form-control" type="time" name="txtti" value="<?php echo $_SESSION['utimein'];?>" id="txtti">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
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