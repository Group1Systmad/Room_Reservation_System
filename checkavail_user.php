<?php
            session_start();
            include 'connect.php';
            //Get data from addsched_user.php
            $empid = $_POST['txteid'];
            $roomid = $_POST['txtrid'];
            $time_in = $_POST['txtti'];
            $time_out = $_POST['txtto'];
            $date = $_POST['txtd'];
            $ucode = $_POST['txtuc'];
            //Get data from addsched.php
            $_SESSION['ueid'] = $empid;
            $_SESSION['urid'] = $roomid;
            $_SESSION['utimein'] = $time_in;
            $_SESSION['utimeout'] = $time_out;
            $_SESSION['udate'] = $date;
            $_SESSION['ucode'] = $ucode;
            date_default_timezone_set('Asia/Manila');
            //Check current time and date
            $date_current = date('Y-m-d');
            $time_current = date('H:i:s');
            //Check current time and date
//            $time_plus = date('H:i:s',strtotime('+ 30 minutes',strtotime($time_current)));
            //Data from tbl_sched
            $SQL = "SELECT * FROM tbl_sched WHERE room_id='$roomid'";
            $res = mysqli_query($con, $SQL);
            //Data from tbl_sched
            //Data from tbl_roomlist
            $SQL1 = "SELECT * FROM tbl_roomlist WHERE room_id='$roomid'";
            $res1 = mysqli_query($con, $SQL1);
            $row1 = mysqli_fetch_array($res1);
            //Data from tbl_roomlist
            $time_open_stamp = strtotime($row1['timeframe_in']);
            $time_close_stamp = strtotime($row1['timeframe_out']);
            $time_open_f = date("H:i", $time_open_stamp);
            $time_close_f = date("H:i", $time_close_stamp);
            $count = mysqli_num_rows($res);
            $i = -1;
            //Check if corrent input of date and time
            if ($date == null OR $time_in == null OR $time_out == null){
                $_SESSION['uerror']= 'notimedate';
                header('location:addsched.php');
            }
            else if ($date < $date_current){
                    $_SESSION['uerror']= 'wrongdate';   
                    header('location:addsched_user.php');
                    }
            else if ($date == $date_current){
                if ($time_in < $time_current OR $time_out < $time_current){
                    $_SESSION['uerror']= 'wrongtime'; 
                    header('location:addsched_user.php');
                    }
                else if ($time_out < $time_in){
                    $_SESSION['uerror']= 'wrongtime';  
                    header('location:addsched_user.php');
                    }
                
                else {   
            while($row = mysqli_fetch_array($res))
            {
                $i++;
                $col[$i]['time_in']=$row['time_in'];
                $col[$i]['time_out']=$row['time_out'];
                $col[$i]['date']=$row['date'];

            }       
            //Check if conflict with other schedules
            if ($count>=1){
                for ($j=0;$j<=$i;$j++){
                    $time_in_stamp = strtotime($col[$j]['time_in']);
                    $time_out_stamp = strtotime($col[$j]['time_out']);
                    $time_in_f = date("H:i", $time_in_stamp);
                    $time_out_f = date("H:i", $time_out_stamp);
                    if ($col[$j]['date'] == $date){
                        if (($time_in_f <= $time_in AND $time_out_f > $time_in))
                        {
                        $_SESSION['uerror']= 'notavail';   
                        $j=$i;
                        header('location:addsched_user.php');
                        }
                        else if (($time_in_f < $time_out AND $time_out_f >= $time_out))
                        {
                        $_SESSION['uerror']= 'notavail';   
                        $j=$i;
                        header('location:addsched_user.php');
                        }    
                        else if (($time_in_f >= $time_in AND $time_out_f <= $time_out))
                        {
                        $_SESSION['uerror']= 'notavail';   
                        $j=$i;
                        header('location:addsched_user.php');
                        } 
                        else
                        {
                        $_SESSION['uerror']= 'avail'; 
                        header('location:add_user.php');
                        }
                    }
                    else
                    {
                    $_SESSION['uerror']= 'avail'; 
                    header('location:add_user.php');
                    }
            }
            }
            else
            {
            $_SESSION['uerror']= 'avail';  
            header('location:add_user.php');
            }
            }
            //Check if conflict with other schedules
           
            }
            else if ($time_out < $time_in){
                    $_SESSION['error']= 'wrongtime';  
                    header('location:addsched_user.php');
                    }
            //Check if corrent input of date and time
            //Check if time is in time frame of the room
            else if (($time_in < $time_open_f) OR ($time_in > $time_close_f)){
                    $_SESSION['uerror']= 'wrongrange';  
                    header('location:addsched_user.php');
                    }
            else if (($time_out < $time_open_f) OR ($time_out > $time_close_f)){
                    $_SESSION['uerror']= 'wrongrange';  
                    header('location:addsched_user.php');
                    }
            //Check if time is in time frame of the room
            else {   
            while($row = mysqli_fetch_array($res))
            {
                $i++;
                $col[$i]['time_in']=$row['time_in'];
                $col[$i]['time_out']=$row['time_out'];
                $col[$i]['date']=$row['date'];

            }       
            //Check if conflict with other schedules
            if ($count>=1){
                for ($j=0;$j<=$i;$j++){
                    $time_in_stamp = strtotime($col[$j]['time_in']);
                    $time_out_stamp = strtotime($col[$j]['time_out']);
                    $time_in_f = date("H:i", $time_in_stamp);
                    $time_out_f = date("H:i", $time_out_stamp);
                    if ($col[$j]['date'] == $date){
                        if (($time_in_f <= $time_in AND $time_out_f > $time_in))
                        {
                        $_SESSION['uerror']= 'notavail';   
                        $j=$i;
                        header('location:addsched_user.php');
                        }
                        else if (($time_in_f < $time_out AND $time_out_f >= $time_out))
                        {
                        $_SESSION['uerror']= 'notavail';   
                        $j=$i;
                        header('location:addsched_user.php');
                        }    
                        else if (($time_in_f >= $time_in AND $time_out_f <= $time_out))
                        {
                        $_SESSION['uerror']= 'notavail';   
                        $j=$i;
                        header('location:addsched_user.php');
                        } 
                        else
                        {
                        $_SESSION['uerror']= 'avail'; 
                        header('location:add_user.php');
                        }
                    }
                    else
                    {
                    $_SESSION['uerror']= 'avail'; 
                    header('location:add_user.php');
                    }
            }
            }
            else
            {
            $_SESSION['uerror']= 'avail';  
            header('location:add_user.php');
            }
            }
            //Check if conflict with other schedules
           
mysqli_close($con);
?>