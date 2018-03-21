<?php
session_start();
?>
<html>
<head>
    <title>Add Records</title>
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
</script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <style>
        .container{
            width: 50%;
            background: #27698d;
            margin: 0 auto;
            margin-top: 10%;
            padding: 20px;
            border-radius: 10px;
        }
        .btn-primary{
            color: #27698d;
            background-color: #fff;
        }
        label{
            color: #fff;
            font-size: small;
        }
       body{
           background: #fff;
       }
        ul{
            background: #27698d;
        }
    </style>
</head>
<body>
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

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
        <table>
            <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            ?>
            <tr>
            <td>ID Number:</td>
            <td><?php echo $row1['Employee_ID']?></td>
            </tr>
            <tr>
            <td>Last Name:</td>
            <td><?php echo $row1['Emp_LN']?></td>
            </tr>
            <tr>
            <td>First Name:</td>
            <td><?php echo $row1['Emp_FN']?></td>
            </tr>
            <tr>
            <td>Address:</td>
            <td><?php echo $row1['Emp_Address']?></td>
            </tr>
            <tr>
            <td>Age:</td>
            <td><?php echo $row1['Emp_Age']?></td>
            </tr>
            <tr>
            <td>Department:</td>
            <td><?php echo $row1['Emp_Department']?></td>
            </tr>
            <tr>
            <td>Gender:</td>
            <td><?php echo $row1['Emp_Gender']?></td>
            </tr>
            <tr>
            <td>Email:</td>
            <td><?php echo $row1['Emp_Email']?></td>
            </tr>
            <tr>
            <td>Contact Number:</td>
            <td><?php echo $row1['Emp_CNumber']?></td>
            </tr>
            <tr>
            <td>Username:</td>
            <td><?php echo $row['Acc_Uname']?></td>
            </tr>
            <tr>
            <td>Password:</td>
            <td><?php echo $row['Acc_Pass']?></td>
            </tr>
            <tr>
                <td align="center"><a href="cell_edit_acc.php?SID=<?php echo $row['id']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                        echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['id']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                        ?></a></td>
            </tr>
        </table>
    </div>



</body>
</html>

