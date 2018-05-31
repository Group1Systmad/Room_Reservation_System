<?php
session_start();
if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}
$id = $_GET['SID'];
?>
 
<html>
    <head>
        <title>Edit Employee's Details</title>
        <style>
       .cont{
        width: 50%;
        background: #27698d;
        margin: 0 auto;
        margin-top: 3%;
        padding: 5px;
        border-radius: 10px;
        }
    input{
        float: right;   
    }
    .child{
        width: 50%;
        margin: 0 auto;
        margin-top: 3%;
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
    <body onload="startTime()" background="bg.jpg">
        <div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><div class="selected"><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></div></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>
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
        $SQL = "SELECT * FROM employee WHERE Employee_ID = '$id'";
        $result = mysqli_query($con,$SQL); //rs.open sql,con
        $row = mysqli_fetch_assoc($result);
        $emp_fn = $row['Emp_FN'];
        $emp_ln = $row['Emp_LN'];
        $emp_add = $row['Emp_Address'];
        $emp_age = $row['Emp_Age'];
        $emp_dept = $row['Emp_Department'];
        $emp_email = $row['Emp_Email'];
        $emp_cn = $row['Emp_CNumber'];
        ?>
        
        <div class="cont">
            <form "form-container" name="edit_employee" method="POST">
                <div class="child">    
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Employee ID</label>
                    <input class="form-control" type="text" name="txteid" value="<?php echo $id;?>" id="txteid" required='true' readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">First Name</label>
                    <input class="form-control" type="text" name="txtefn" value="<?php echo $emp_fn;?>" id="txtefn" required='true'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Last Name</label>
                    <input class="form-control" type="text" name="txteln" value="<?php echo $emp_ln;?>" id="txteln" required='true'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Address</label>
                    <input class="form-control" type="text" name="txteaddr" value="<?php echo $emp_add;?>" id="txteaddr" required='true'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Department</label>
                    <input class="form-control" type="text" name="txtedept" value="<?php echo $emp_dept;?>" id="txtedept" required='true'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Email Address</label>
                    <input class="form-control" type="text" name="txtemail" value="<?php echo $emp_email;?>" id="txtemail" required='true'>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtid">Contact Number</label>
                    <input class="form-control" type="text" name="txtecn" value="<?php echo $emp_cn;?>" id="txtecn" required='true'>
                </div>
            </div>
            <div class="form-group row">
            <div class="col-md-6">
                <input class="btn btn-primary" type="submit" value="Update" formaction="emp_edit.php">
            </div>   
            <div class="col-md-6">
                    <input class="btn btn-danger" type="submit" value="Cancel" formaction="employees.php">
            </div>
                            
            </div>
        </form>

</div>
        </div>
    </body>
</html>



