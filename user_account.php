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
    
    .portrait{
                margin: 0 auto;
                text-align: center;
                width: 100%;
                position: absolute;
                padding-bottom: 50px;
            }
            .icon_portrait{
                margin-top: 50px;
                border-radius: 100%;
                height: 200px;
/*                width: 200px;*/
                max-height: 200px;
                border: 5px solid #fff;
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
</style>
<script type="text/javascript">
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

</script>
</head>
<body>

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
if ($_SESSION['acctype'] == 'user') {
    $sidebar = '<div class="sidebar">';
  
    $sidebar .= '<ul>';
    $sidebar .= ' <li> <img src =' . 'logo3.png'.  ' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>';
   $sidebar .= '<li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>';
    $sidebar .= ' <li><div class="selected"><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></div></li>';
    $sidebar .= '<li><a href="aboutususer.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>';
    $sidebar .= '<li><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>';
    $sidebar .= '<li><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></li>';
    $sidebar .= '</ul>';
    $sidebar .= '</div>';
    echo $sidebar;
}else{
    
      $sidebar =  '<div class="sidebar">';
    $sidebar .= '<ul>';
    $sidebar .= ' <li> <img src =' . 'logo3.png'.  ' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>';
    $sidebar .= '<li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>';
   $sidebar .= ' <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>';
    $sidebar .= '<li><a href="aboutusadmin.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>';
     $sidebar .= '<li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>';
    $sidebar .= '<li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>';
    $sidebar .= '</ul>';
    $sidebar .= '</div>';
    echo $sidebar;
}

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
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            function changeimage($empno,  $file_temp, $file_extn){
            include 'connect.php';
            $con = mysqli_connect("localhost","root","");
            $file_path = 'C:/xampp/htdocs/Room_Reservation_System/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
            if (move_uploaded_file($file_temp, $file_path)) {
                echo "<P>Profile picture updated successfully!</P>";
                }
            else {
               echo "<P>Upload failed! Please select a file lower than 2MB</P>";}
                 $SQL= "update `employee` set `profile`='$file_path' WHERE Employee_ID='$empno'";
                    mysqli_query($con,$SQL)or die('Error:'.mysqli_error($con));
                    mysqli_close($con);
                    header('location:admin_account.php');
       }
     
      
      if (isset($_FILES['profile']) === TRUE){
          if (empty($_FILES['profile']['name']) === TRUE){
              echo 'Please choose a file';
          }
          else {
              $allowed = array('jpg','jpeg','gif', 'png');
                      $file_name = $_FILES['profile']['name'];
                      $file_extn = strtolower (end(explode('.', $file_name)));
                      $file_temp = $_FILES['profile']['tmp_name'];
                      
                      if (in_array($file_extn, $allowed) === true){
                           changeimage($row['Employee_ID'],  $file_temp, $file_extn);
                      }
                     else {                          
                         echo 'Incorrect file type! Allowed: ';
                         echo implode(', ', $allowed);                        
                     }            
          }
      }

       ?>
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
                <img class="icon_portrait" src= "jay.jpg" alt="User Portrait">
            </div>
             <div class="cover"> </div>
        </div>
    
    <div class="container">
        <div class="user-identity">
            <h3 class="userfullname"><?php echo $fullname?></h3>
            <p>ID: <span class="userid"><?php echo $row['Employee_ID'];?></span></p>
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