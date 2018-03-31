<?php
session_start();
?>
<html>
<head>
    <title>Home Page</title>
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
             document.getElementsByClassName("container").style.marginLeft = "250px";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementsByClassName("container").style.marginLeft= "0";
}
</script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
    
    
</head>

<body>
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

?>
    
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
                <a class="hoverable" href="#">Change Password</a>
                  <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
          
</div>
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Account</span></a></li>
        <li><div class="selected"><a href="userpage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></div></li>
        <li><a href="aboutususer.php"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li><a href="user_schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="user_reservation.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Your Reservations</span></a></li>
    </ul>
</div>
<div class="container">
    <div class="jumbotron">
<!--Edit Mar-->
        <h1>Room Reservation App</h1>
        <p>Together with the Smart Reservation Tool (SMART), you can have no worries in booking reservations for a specific room in your organization.</p>
        <p>Just click <a href="addsched.php">here</a> to reserve!</p>
    </div>
    <div class="row">
        <div class="jumbotron overview_active col-md-3">
            <h1>
                <?php
                include 'connect.php';
                $result = mysqli_query($con,"SELECT * FROM tbl_sched WHERE Status='1'");
                $rows = mysqli_num_rows($result);
                echo $rows . "/10 ";
                mysqli_close($con);
                ?>
            </h1>
            <p>rooms are reserved</p>
        </div>
        <div class="table_view col-md-9">
            <table class="table">
                <tr class="headers">
                    <td>Room ID</td>
                    <td>Employee ID</td>
                    <td>Time In</td>
                    <td>Time Out</td>
                    <td>Date</td>
                    <td>Status</td>
                </tr>
                <?php //1st
                include 'connect.php';
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                $results_per_page = 4   ;
                $start_from = ($page-1) * $results_per_page;
                $SQL ="SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY id LIMIT $start_from, ".$results_per_page;
                $res = mysqli_query($con, $SQL);
                while($row= mysqli_fetch_array($res)){
                ?> 
<!--                1st-->
                <tr>
                    <td><?php echo $row['room_id']; ?></td>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['time_in']; ?></td>
                    <td><?php echo $row['time_out']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo "ACTIVE"; ?></td>
                </tr>

                <?php //2nd

                }//close of while
                mysqli_close($con);

                ?><!-- 2nd -->
            </table>
       
            <div class="center">
                <div class="page-footers">

                    <?php
                    include 'connect.php';
                    $sql = "SELECT COUNT(id) AS total FROM tbl_sched WHERE Status=1";
                    $res = mysqli_query($con, $sql);
                    $row= mysqli_fetch_array($res);
                    $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
		
                    for ($i=1; $i<=$total_pages; $i++) {
                        echo "<a class='pages";
                        echo ($i==$page) ? ' curPage\'' : '\'';
                        echo " href='homepage.php?page=".$i."'";

                        echo ">".$i."</a> ";
                    };
                    ?>
                    
                </div>
            </div>

        </div>
    </div>

</body>

</html>