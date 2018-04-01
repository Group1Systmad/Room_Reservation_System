<?php
            session_start();
            include 'connect.php';
            $empid = $_POST['txteid'];
            $roomid = $_POST['txtrid'];
            $time_in = $_POST['txtti'];
            $time_out = $_POST['txtto'];
            $date = $_POST['txtd'];
            $_SESSION['urid'] = $roomid;
            $_SESSION['utimein'] = $time_in;
            $_SESSION['utimeout'] = $time_out;
            $_SESSION['udate'] = $date;
            date_default_timezone_set('Asia/Manila');
            $date_current = date('Y-m-d');
            $time_current = date('H:i:s');
            $SQL = "SELECT * FROM tbl_sched WHERE room_id='$roomid'";
            $res = mysqli_query($con, $SQL);
            $count = mysqli_num_rows($res);
            $i = -1;
            if ($date < $date_current){
                    $_SESSION['uerror']= 'wrongdate';   
                    header('location:addsched.php');
                    }
            else if ($date == $date_current){
                if ($time_in < $time_current OR $time_out < $time_current){
                    $_SESSION['uerror']= 'wrongtime'; 
                    header('location:addsched.php');
                    }
                    else if ($time_out < $time_in){
                    $_SESSION['uerror']= 'wrongtime';  
                    header('location:addsched.php');
                    }
            }
            else if ($time_out < $time_in){
                    $_SESSION['uerror']= 'wrongtime';  
                    header('location:addsched.php');
                    }
            else{      
            while($row = mysqli_fetch_array($res))
            {
                $i++;
                $col[$i]['time_in']=$row['time_in'];
                $col[$i]['time_out']=$row['time_out'];
                $col[$i]['date']=$row['date'];

            }
            if ($count>=1){
                for ($j=0;$j<=$i;$j++){
                    $time_in_stamp = strtotime($col[$j]['time_in']);
                    $time_out_stamp = strtotime($col[$j]['time_out']);
                    $time_in_f = date("H:i", $time_in_stamp);
                    $time_out_f = date("H:i", $time_out_stamp);
                    if ($col[$j]['date'] == $date){
                        if (($time_in_f <= $time_in AND $time_out_f >= $time_in))
                        {   
                        $_SESSION['uerror']= 'notavail';   
                        header('location:addsched_user.php');
                        $j=$i;
                        }
                        else if (($time_in_f <= $time_out AND $time_out_f >= $time_out))
                        {   
                        $_SESSION['uerror']= 'notavail';  
                        header('location:addsched_user.php');
                        $j=$i;
                        }    
                        else if (($time_in_f >= $time_in AND $time_out_f <= $time_out))
                        {   
                        $_SESSION['uerror']= 'notavail';  
                        header('location:addsched_user.php');
                        $j=$i;
                        } 
                        else
                        {
                        $_SESSION['uerror']= 'notavail';  
                        header('location:addsched_user.php');
                        }
                    }
                    else
                    {
                    $_SESSION['uerror']= 'avail';    
                    header('location:addsched_user.php');
                    }
            }
            }
            else
            {
            $_SESSION['uerror']= 'avail';  
            header('location:addsched_user.php');
            }
            }
mysqli_close($con);
?>