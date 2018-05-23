<?php
session_start();
?>
<html>
<head>
    <title>Home Page</title>
    <script type="text/javascript">
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var n= today.getMonth();
    var o= today.getDate();
    var p= today.getFullYear();
    if (h>=13){h= h-12; }
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    n = n+1;
    n = checkTime(n);
    o = checkTime(o);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    document.getElementById('da').innerHTML =
    n + "/" + o + "/" + p;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
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

var countDownDate = new Date(reservationtime).getTime();

var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
 </script>
 

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
    <style>
        #jumbo-header{
            color: #FFF;
        }
        #room-preview{
            height: 40%;
        }
    </style>
</head>

<body onload="startTime()" >
    
<?php
    $_SESSION['changed'] = 0;
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";
    
?>
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li> 
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><div class="selected"><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></div></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
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
            $_SESSION['employee_num'] = $row['Employee_ID'];
            ?>
            <div class="center"> <img src= "<?php  if (empty($row1['Emp_Photo'])){ echo "Male User_96px.png";} else {echo $row1['Emp_Photo'];}?>" style="border-radius: 100%; max-height: 90px;">
            <div class="name"> <?php echo $row1['Emp_FN']; ?> <?php echo $row1['Emp_LN']; ?> </div>
            <div class="id"> ID Number: <?php echo $row['Employee_ID']; ?> </div>
            <hr>
            <a class="hoverable" href="admin_account.php">Account Info</a> 
            <a  class="hoverable" href="change_pass.php">Change Password</a> 
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
</div>

    

<div class="container">
    <div class="row" style="margin-left: 0%; text-align: center; ">
     <div class="clock" div style="border-radius: 8px; max-height: 80px; width: 93%; padding-top: 1%; position: relative">
         <span class="h1" style="font-size: 45px; color: #22315d;font-family: Book Antiqua; "> <div id="txt"></div></span>
        <p style="font-size: 16px"><div id="da"></div></p>
     </div> </div>
    
    <div class="row" style=" padding-top: 1%; margin-left: 25px">
    <div class="table_view col-lg-7" div style="max-height: 40%; border-radius: 8px; vertical-align: middle;">
        <img src="office.jfif" style="width: 102%; margin-left: 1px; height: ">
        <div class="black" style="position: absolute; bottom: 0; background: rgba(0, 0, 0, 0.5); color: #f1f1f1; width: auto; padding: 10px;">
        <!--Edit Mar-->
        <span class="h1" style="font-size: 40px; " id="jumbo-header"> Room Reservation App</span>
        <p style="font-size: 18px">Together with the Smart Reservation Tool (SMART), you can have no worries in booking reservations for a specific room in your organization.</p>
        <p style="font-size: 16px">Just click <a href="addsched.php" style="color: #ff7a24">here</a> to reserve!</p>
        </div>
        </div>
    <div class="table_view col-md-3" style="width: 34%; background-color: #304582; margin-left: 1%; border-radius: 8px; height: 40%; ">
     <span style="font-size: 20px; color: white;">Announcements </span> 
     <a onclick="return PopupCenter('announce.php','Post Announcements ','500','400');  "style="font-size: 12px; color: white;padding-left: 10px; cursor: pointer">edit</a>
     <hr>
     <span style="color:white; font-size: 12px; margin-left: 36px">
         <?php 
            include 'connect.php';
            $sql2 ="select announcements from announcement_table where ID='1'";
            $res2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_array($res2);
            echo $row2['announcements'];
            ?>
     </span>
     <hr>
     <span style="font-size: 17px; color: white;">Notifications </span> 
     <span style="color: #fff; padding-left: 40px; font-size: 12px">
            <p></p> <p></p> <p></p> <p></p> <p></p>
            <?php
            $counter = 0;
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
             $sql3 ="select * from tbl_sched where emp_id='".$row['Employee_ID']."'";
            $res3 = mysqli_query($con, $sql3);
             while($row3= mysqli_fetch_array($res3)){
            $date1 = date("Y-m-d"); 
            date_default_timezone_set('Asia/Manila');
            $date = time();
            
             $hours_remaining =  strtotime($row3['time_in']) - $date;
             $hours_remaining = floor($hours_remaining/3600);
             
            if ($date1 == $row3['date']) {
                $counter++;
                if($hours_remaining >=1)
               {echo "You have a reservation at room ";
                echo $row3['room_id'];
                echo " in ";
                echo $hours_remaining;
                    if ($hours_remaining == 1) {
                    echo " hour.   ";}
                    if($hours_remaining > 1) { echo " hours.   ";}
                     $notif = '<span><a href="schedtable.php" style="color: #ff7a24;">View</a></span>';
                     echo $notif;
                     echo "<p></p>";
            }}
            }
            if ($counter == 0){ echo "No notifications";}
   
            ?>
            
         </span>
   
            <p></p> <p></p> <p></p> <p></p> <p></p>
            
    </div></div>
    
    <div class="row" style="padding-top: 1%; margin-left: 40px">
        <div class="jumbotron overview_active col-md-5">
            <h1>
                <?php
                include 'connect.php';
                $result = mysqli_query($con,"SELECT * FROM tbl_sched WHERE Status='1'");
                $rows = mysqli_num_rows($result);
                echo $rows . "/10 ";
                mysqli_close($con);
                $_SESSION['same'] = false;
                ?>
            </h1>
            <p>rooms are reserved</p>
          
        </div>
        <div class="table_view col-md-8" style="background-color: #e6e6ff; margin-left: 1%; border-radius: 8px" id="room-preview">
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
                    //edit ni bren
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>