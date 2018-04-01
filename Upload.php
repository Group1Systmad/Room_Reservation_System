<?php
  $con = mysqli_connect("localhost","root","");
$select_db=mysqli_select_db($con,"db_sched");
if (!$select_db)
	{
		die('Could not connect:' .mysqli_error($con));
	}
         $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            $username = $_SESSION['username'];
            $id = $row['Employee_ID'];
            
       function changeimage($username,  $file_temp, $file_extn ){
           include 'connect.php';
            $file_path = 'Room_Reservation_System/profile/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
            move_uploaded_file($file_temp, $file_path);
            $sql = "UPDATE 'employee' SET 'profile' = '".$file_path."' WHERE username ='".$username."'";
            mysqli_query($con, $sql);
       }
        
?>


