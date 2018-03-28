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
  
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>
        <li><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutususer.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><div class="selected"><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></div></li>
    </ul>
</div>
    
    
<div id="myAccountnav" class="accnav"style="top:70px;">
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

<div class="container">
        <table class="table">
            <tr class="headers" style="color:#00b3b3">
                <td>Remove</td>
                <td>Edit</td>
                <td>ReservationID</td>
                <td>RoomID</td>
                <td>EmployeeID</td>
                <td>TimeIn</td>
                <td>TimeOut</td>
                <td>Date</td>
                <td>UniqueCode</td>
                <td>Status</td>
            </tr>
            <?php
            include 'connect.php';
            $SQL ="SELECT * FROM accounts WHERE Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $SQL);
            $row1= mysqli_fetch_array($res);
            $sql1 ="select * from tbl_sched WHERE emp_id='".$row1['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $_SESSION["result_set"] = $res1;
            while($row= mysqli_fetch_array($res1))
            {
            ?>
            <form <?php echo ($_SESSION["count"]==2) ? 'method=\'post\' action=\'cell_edit_user.php\'' : '' ?>>
            <tr>
                <td align="center"><a onclick="return del()" href="delsched_user.php?SID=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
<!--                <td align="center"><a href="editsched.php?SID=--><?php //echo $row['id']; ?><!--"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
                <td align="center"><a href="cell_edit_user.php?SID=<?php echo $row['id']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                        echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                        ?></a></td>
<!--                <td>--><?php //echo $row['id']; ?><!--</td>-->
                    <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="reserv_id" id="reserv_id" value=<?php echo $row['id']; ?> readonly></td>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="room_id" id="room_id" value=<?php echo $row['room_id']; ?> <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>> </td>
                <td><input class="table_cell <?php echo 'cell'.$row['id']?>" name="emp_id" id="emp_id" value=<?php echo $row['emp_id']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_in" value="<?php echo $row['time_in']; ?>"  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_out" value=<?php echo $row['time_out']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="date" class="table_cell <?php echo 'cell'.$row['id']?>" name="date" value=<?php echo $row['date']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="text" class="table_cell <?php echo 'cell'.$row['id']?>" name="unique" id="unique" value=<?php echo $row['u_code']; ?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "readonly" : ""?>></td>
                <td><input type="checkbox" class="table_cell <?php echo 'cell'.$row['id']?>" name="status" <?php echo ($row['Status'] == TRUE) ? "checked" : "";?>  <?php echo ($_SESSION["count"]==2 && $row['id']!=$_SESSION["selected"]) ? "disabled = \"disabled\"" : ""?>></td>
            </tr>
            </form>
            <?php //open of second php
            }//close of while
            mysqli_close($con);
            ?><!-- close of second php -->
        </table>
     <a href="addsched_user.php"> <button class="btn btn-primary" style="margin-top: 45px">Add Reservation</button></a><br>

        <font size="4" face="arial"  color="#ff7a24">
            <?php
            include 'connect.php';
            $SQL ="SELECT * FROM accounts WHERE Acc_Uname='".$_SESSION['username']."'";
            $res2 = mysqli_query($con, $SQL);
            $row2= mysqli_fetch_array($res2);
            $sql1 ="select * from tbl_sched WHERE emp_id='".$row2['Employee_ID']."'";
            $res3 = mysqli_query($con, $sql1);
            $rows = mysqli_num_rows($res3);
            echo "<br>";
            echo "You have " . $rows . " reservation(s). ";
            mysqli_close($con);
            ?>
        </font>
</div>
</body>
</html>