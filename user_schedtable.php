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
                <td>Reservation ID</td>
                <td>Room ID</td>
                <td>Employee ID</td>
                <td>Time In</td>
                <td>Time Out</td>
                <td>Date</td>
                <td>Status</td>
            </tr>
            <?php
            include 'connect.php';
            $sql ="select * from tbl_sched order by id";
            $res = mysqli_query($con, $sql);
            $_SESSION["result_set"] = $res;
            while($row= mysqli_fetch_array($res))
            {
            ?>
            <form <?php echo ($_SESSION["count"]==2) ? 'method=\'post\' action=\'cell_edit.php\'' : '' ?>>
            <tr>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="reserv_id" id="reserv_id" value=<?php echo $row['id']; ?> readonly></td>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="room_id" id="room_id" value=<?php echo $row['room_id']; ?> readonly> </td>
                <td><input class="table_cell <?php echo 'cell'.$row['id']?>" name="emp_id" id="emp_id" value=<?php echo $row['emp_id']; ?>  readonly></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_in" value=<?php echo $row['time_in']; ?> readonly></td>
                <td><input type="time" class="table_cell <?php echo 'cell'.$row['id']?>" name="time_out" value=<?php echo $row['time_out']; ?>  readonly></td>
                <td><input type="date" class="table_cell <?php echo 'cell'.$row['id']?>" name="date" value=<?php echo $row['date']; ?>  readonly"></td>
                <td><input class="<?php echo 'cell'.$row['id']?> table_cell" name="status" id="status" value=<?php 
                    if ($row['Status'] == 1){
                        echo 'ACTIVE';
                    }
                    else if ($row['Status'] == 0) {
                        echo 'INACTIVE';
                    }
                
                ?>  readonly></td>
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

            $result = mysqli_query($con,"select * from tbl_sched");
            $rows = mysqli_num_rows($result);
            echo "<br>";
            echo "There are " . $rows . " record(s) in the table. ";
            mysqli_close($con);
            ?>
        </font>
</div>
</body>
</html>