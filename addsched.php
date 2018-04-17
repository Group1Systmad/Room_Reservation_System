<?php
session_start();

?>
<html>
    <head>
        <title>Add New Schedule</title>
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
    <link rel="stylesheet" href="mika/aboutus.css" type="text/css">

<style>
    .container{
        width: 50%;
        background: #27698d;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
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
</style>
</head>
<body>

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
            <a href="admin_account.php">Account Info</a> 
             <div class="logoutbtn"> <a onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
</div>
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><div class="selected"><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></div></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
    </ul>
</div>

<div class="container">
        <form class="form_container" name="addsched" method="post">
            <div class="child">    
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtrid">Room Number</label>
                    <input class="form-control" type="text" name="txtrid" value="<?php echo $_SESSION['rid'];?>" id="txtrid" placeholder="Room Number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txteid">Employee ID</label>
                    <input class="form-control" type="text" name="txteid" value="<?php echo $_SESSION['eid'];?>" id="txteid" placeholder="Employee ID" required="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtti">Time In</label>
                    <input class="form-control" type="time" name="txtti" value="<?php echo $_SESSION['timein'];?>" id="txtti">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtto">Time Out</label>
                    <input class="form-control" type="time" name="txtto" value="<?php echo $_SESSION['timeout'];?>" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtd">Date</label>
                    <input class="form-control" type="date" name="txtd" value="<?php echo $_SESSION['date'];?>" id="txtd">
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
                if ($_SESSION['error'] != 'avail'){ ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Check Availability" formaction="checkavail.php">
                </div>   
                <div class="col-md-6">
                    <input class="btn btn-danger" type="reset" value="Clear">
                </div>   
                <?php }
                else if ($_SESSION['error']=='avail'){
                
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room Available.")';
                echo '</script>';  
                ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save" formaction="add.php">
                </div>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="submit" value="Cancel" formaction="schedtable.php">
                </div>
                <?php }?>
                
            </div>
        </form>

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
                else if ($_SESSION['error']== 'notavail'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room not available. Input another room or time and date")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                ?>
</body>
</html>