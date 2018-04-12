/<?php
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
    .table{
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
            height: 80%;
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
             document.getElementById("myAccountnav").style.border = "1px solid black";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementById("myAccountnav").style.border = "none";
}

</script>
</head>
<body>

<?php
if (isset($_SESSION["count"])){
    echo "Count: ".$_SESSION["count"];
    echo "Selected ".$_SESSION["selected"];
}else{
    echo "Session is not set";
}
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
            $profilepic = $row1['profile'];
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
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="#" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
    </ul>
</div>
    
     <div class="profnav col-md-5">
         <div class="t1 col-md-6"><p><img src= "<?php  if (empty($row1['profile'])){ echo "Male User_96px.png";} else {echo $row1['profile'];}?>"style="; max-width: 260px; max-height: 360px;"></p></div>
         <div class="t1 col-md-6"><p style="font-size:12px; color:white; margin-left: 10px; margin-top: 280px"> Change your avatar</p>
         <form action="" method="post" enctype="multipart/form-data" style="color: #000033;margin-left: 10px; margin-top:10px">
        <input type="file" name="profile" style="color:black"> 
        <input type="submit" name="submit" style="color:black">
      </form>        
         </div>
     </div>
    <div class="center"> 
             <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            function changeimage($empno,  $file_temp, $file_extn){
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            $file_path = 'E:/xampp/htdocs/Room_Reservation_System/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
            $file_photo = substr(md5(time()), 0, 10) . '.' . $file_extn;
            if (move_uploaded_file($file_temp, $file_path)) {
                echo "<P>Profile picture updated successfully!</P>";
                $SQL= "UPDATE employee SET Emp_Photo='$file_photo' WHERE Employee_ID='".$row['Employee_ID']."'";
                echo $SQL;
                    mysqli_query($con,$SQL)or die('Error:'.mysqli_error($con));
                    mysqli_close($con);
                }
            else {
               echo "<P>Upload failed! Please select a file lower than 2MB</P>";}
                 
       }
     
      
      if (isset($_FILES['profile']) === TRUE){
          if (empty($_FILES['profile']['name']) === TRUE){
              echo 'Please choose a file';
          }
          else {
              $allowed = array('jpg','jpeg','gif', 'png');
                      $file_name = $_FILES['profile']['name'];
                      $explode = explode('.', $file_name);
                      $end = end($explode);
                      
                      $file_extn = strtolower($end);
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
      
  </div>
     <div class="container">
         <div class="tableview col-md-7">
                 <div class="greeting"> ADMINISTRATOR  </div> 
        <table class="table">
            <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            ?>
            
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
<!--            <tr>
                <td>Edit</td>
                <td align="center"><a href="cell_edit_acc.php?SID=<?php echo $row['Employee_ID']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                        echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                        ?></a></td>
            </tr>-->
                    
            </form>
        </table>
         </div>
</div>
</body>
</html