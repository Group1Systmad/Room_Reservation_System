<?php
session_start();
?>

<head>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
<!--    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
<title>Reservations' List</title>
<style>
/*    .table{
        width: 70%;
        margin: 0 auto;
    }
    .container{
        margin-top: 2%;
        text-align: center;
    }
    .headers{
        text-align: center;
        font-size: medium;
    }

     td{
        font-size: 14px;
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
    
    .greeting{
       color: #ff7a24;
       font-size: 40px;
       font-family: Lucida Console, fantasy;
    }
    
    .profnav{
            width: 35%;
            height: 20%;
            background: #000033;
            color: #fff;
            padding: 40px 20px 10px 20px;
            text-align: left;
            padding-top:30px;
            margin-top: 30px;
            margin-left: 90px;
        }
        
        .tableview{
            height: 100%;
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

    }*/
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
             //document.getElementById("myAccountnav").style.border = "1px solid black";
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

//<?php
//if (isset($_SESSION["count"])){
//    echo "Count: ".$_SESSION["count"];
//    echo "Selected ".$_SESSION["selected"];
//}else{
//    echo "Session is not set";
//}
//?>
  
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
            $username = $_SESSION['username'];
            ?>
            <div class="center"> <img src= "<?php  if (empty($row1['profile'])){ echo "Male User_96px.png";} else {echo $row1['profile'];}?>"style="border-radius: 100%; max-height: 90px;">
            <div class="name"> <?php echo $row1['Emp_FN']; ?> <?php echo $row1['Emp_LN']; ?> </div>
            <div class="id"> ID Number: <?php echo $row['Employee_ID']; ?> </div>
            <hr>
            <a class="hoverable" href="user_account.php">Account Info</a> 
            <a class="hoverable" href="user_account.php">Change Password</a> 
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
</div>
    
<?php 

    
      $sidebar =  '<div class="sidebar">';
    $sidebar .= '<ul>';
    $sidebar .= ' <li> <img src =' . 'logo3.png'.  ' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>';
    $sidebar .= '<li><div class="selected"><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></div></li>';
   $sidebar .= ' <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>';
    $sidebar .= '<li><a href="aboutusadmin.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>';
     $sidebar .= '<li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>';
    $sidebar .= '<li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>';
    $sidebar .= '<li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>';
    $sidebar .= '<li><div id="time" style="padding-top:20px; font-size: 18px; color:white;text-align: center"></div> </li>';
    $sidebar .='<li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>';
    $sidebar .= '</div>';
    echo $sidebar;

?>
    
<!--     <div class="profnav">
         <div class="t1 col-md-6"><p><img src= "<?php  if (empty($row1['profile'])){ echo "Male User_96px.png";} else {echo $row1['profile'];}?>"style="; max-width: 260px; max-height: 360px;"></p></div>
         <form action="" method="post" enctype="multipart/form-data" style="color: #ebebe0;margin-left: 10px; margin-top:10px">
             <p style="font-size:12px; color:white; margin-left: 10px; margin-top: 10%"> Change your avatar</p>
        <input type="file" name="profile"> 
        <input type="submit" name="submit" style="color:black">
        </form>         
         
     </div>-->
 
     
        <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($res);
            $id_emp = $row['Employee_ID'];
            
            $sql1 ="select * from employee where Employee_ID='".$id_emp."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_assoc($res1);
            
            $fullname = $row1['Emp_FN'] ." ". $row1['Emp_LN'];
            ?>

     <div class="cover-container">
            <div class="portrait">
              <div class="imgcont">
                    <img src= "<?php  if (empty($row1['Emp_Photo'])){ echo "Male User_96px.png";} else {echo $row1['Emp_Photo'];}?>" alt="User Portrait" style=" display: block; border-radius: 100%;width: 200px; max-height: 200px;border: 5px solid #fff;">
                    <div class="overlay"><a onclick="return PopupCenter('uploadpicture.php','Update Profile ','450','600');  " style="color: white;">Edit</a></div>   
              </div>
              </div>
             <div class="cover"> </div>
        </div>
          
    
<div class="container" style="padding-top: 50px">
        <div class="user-identity">
            <h3 class="userfullname"><?php echo $fullname?></h3>
            <p>ID: <span class="userid"><?php echo $row['Employee_ID'];?></span></p>
        </div>
        </div>
        
        
        <div class="container">
            <div class="row">
                <div class="col-md-6 half">
                Basic Information
                <table class="table">
                    <tr>
                        <td>First Name:</td>
                        <td><?php echo $row1['Emp_FN'];?></td>
                    </tr>
                    <tr>
                        <td>Middle Name:</td>
                        <td>N/A</td>
                    </tr>
                    <tr>
                         <td>Last Name:</td>
                        <td><?php echo $row1['Emp_LN'];?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?php echo $row1['Emp_Gender'];?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $row1['Emp_Address'];?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 half">
                Contact Details
                <table class="table">
                    <tr>
                        <td>Mobile Number</td>
                        <td><?php echo $row1['Emp_CNumber'];?></td>
                    </tr>
                    <tr>
                        <td>Telephone Number</td>
                        <td>N/A</td>
                    </tr>
                    <tr>
                        <td>Email Address</td>
                        <td><?php echo $row1['Emp_Email'];?></td>
                    </tr>
                </table>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 half">
                    Account Details
                    <table class="table">
                        <tr>
                        <td>User Name</td>
                        <td><?php echo $row['Acc_Uname'];?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>**** <a class="change-pass-link" href="#">Change Password</a></td>
                        </tr>
                        <tr>
                            <td>Account Type</td>
                            <td id="account_type"><?php echo $row['acc_type'];?></td>
                        </tr>
                    </table>
                    
                </div>
                <div class="col-md-6 half">
                    Company Details
                    <table class="table">
                        <tr>
                            <td>Department</td>
                            <td><?php echo $row1['Emp_Department'];?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>Front End Designer</td>
                        </tr>
                        <tr>
                            <td>Employed Since</td>
                            <td>03/01/2018</td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
<!--    <div class="center"> 
            
            
            <form <?php echo ($_SESSION["count"]==2) ? 'method=\'post\' action=\'cell_edit_acc.php\'' : '' ?>>
            
            <tr>
                <td>ID Number:</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_id" id="emp_id" value=<?php echo $row['Employee_ID']; ?> readonly></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_ln" id="emp_ln" value=<?php echo $row1['Emp_LN']; ?> readonly></td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_fn" id="emp_fn" value=<?php echo $row1['Emp_FN']; ?> readonly></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_add" id="emp_add" value=<?php echo $row1['Emp_Address']; ?> readonly></td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_age" id="emp_age" value=<?php echo $row1['Emp_Age']; ?> readonly></td>
            </tr>
            <tr>   
                <td>Department:</td> 
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_dep" id="emp_dep" value=<?php echo $row1['Emp_Department']; ?> readonly></td>
            </tr>
            <tr>   
                <td>Email:</td>    
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_email" id="emp_email" value=<?php echo $row1['Emp_Email']; ?> readonly></td>
            </tr>
            <tr>  
                <td>Gender:</td>  
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_gen" id="emp_gen" value=<?php echo $row1['Emp_Gender']; ?> readonly></td>
            </tr>
            <tr>  
                <td>Contact Number:</td>    
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_cno" id="emp_cno" value=<?php echo $row1['Emp_CNumber']; ?> readonly></td>
            </tr>
            <tr> 
                <td>Username:</td>    
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_uname" id="emp_uname" value=<?php echo $row['Acc_Uname']; ?> <?php echo ($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) ? "readonly" : ""?>> </td>
            </tr>
            <tr>   
                <td>Password:</td>  
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_pass" id="emp_pass" value=<?php echo $row['Acc_Pass']; ?> <?php echo ($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) ? "readonly" : ""?>> </td>
            </tr>
            <tr>
                <td>Edit</td>
                <td align="center"><a href="cell_edit_acc.php?SID=<?php echo $row['Employee_ID']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                        echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                        ?></a></td>
            </tr>
                    
            </form>
        </table>
         </div>
</div>-->
</body>
</html