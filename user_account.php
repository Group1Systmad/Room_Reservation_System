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
<title>Reservations' List</title>
<style>
    .table{
        width: 30%;
        margin: 0 auto;
    }
    .container{
        margin-top: 10%;
        text-align: center;
    }
    .headers{
        text-align: center;
        font-size: medium;
    }
    td{
        font-size: small;
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
        <li><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="user_account.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>
        <li><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></li>
        <li><a onclick="return logout()" href="login_page.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Log Out</span></a></li>
   
    </ul>
</div>

    <div class="container">
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
                <td>ID Number</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_id" id="emp_id" value=<?php echo $row['Employee_ID']; ?> readonly></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_ln" id="emp_ln" value=<?php echo $row1['Emp_LN']; ?> readonly></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_fn" id="emp_fn" value=<?php echo $row1['Emp_FN']; ?> readonly></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_add" id="emp_add" value=<?php echo $row1['Emp_Address']; ?> readonly></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_age" id="emp_age" value=<?php echo $row1['Emp_Age']; ?> readonly></td>
            </tr>
            <tr>   
                <td>Department</td> 
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_dep" id="emp_dep" value=<?php echo $row1['Emp_Department']; ?> readonly></td>
            </tr>
            <tr>   
                <td>Email</td>    
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_email" id="emp_email" value=<?php echo $row1['Emp_Email']; ?> readonly></td>
            </tr>
            <tr>  
                <td>Gender</td>  
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_gen" id="emp_gen" value=<?php echo $row1['Emp_Gender']; ?> readonly></td>
            </tr>
            <tr>  
                <td>Contact Number</td>    
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_cno" id="emp_cno" value=<?php echo $row1['Emp_CNumber']; ?> readonly></td>
            </tr>
            <tr> 
                <td>Username</td>    
                <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_uname" id="emp_uname" value=<?php echo $row['Acc_Uname']; ?> <?php echo ($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) ? "readonly" : ""?>> </td>
            </tr>
            <tr>   
                <td>Password</td>  
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



</body>
</html>

