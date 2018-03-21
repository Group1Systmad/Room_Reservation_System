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
            <tr class="headers">
                <td>Remove</td>
                <td>Edit</td>
                <td>Reservation ID</td>
                <td>Room ID</td>
                <td>Employee ID</td>
                <td>Time In</td>
                <td>Time Out</td>
                <td>Date</td>
                <td>Unique Code</td>
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
    <a href="addsched_user.php"> <button class="btn btn-primary">Add Reservation</button></a><br>

        <font size="4" face="arial"  color="blue">
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