<?php
            session_start();
            include 'connect.php';
            $empid = $_POST['txteid'];
            $roomid = $_POST['txtrid'];
            $time_in = $_POST['txtti'];
            $time_out = $_POST['txtto'];
            $date = $_POST['txtd'];
            $_SESSION['eid'] = $empid;
            $_SESSION['rid'] = $roomid;
            $_SESSION['timein'] = $time_in;
            $_SESSION['timeout'] = $time_out;
            $_SESSION['date'] = $date;
            $SQL = "SELECT * FROM tbl_sched WHERE room_id='$roomid'";
            $res = mysqli_query($con, $SQL);
            $count = mysqli_num_rows($res);
            $row= mysqli_fetch_array($res);
            $time_in_stamp = strtotime($row['time_in']);
            $time_out_stamp = strtotime($row['time_out']);
            $time_in_f = date("H:i", $time_in_stamp);
            $time_out_f = date("H:i", $time_out_stamp);
            if ($count == 1){
                if ($row['date'] == $date){
                    if (($time_in_f <= $time_in AND $time_out_f >= $time_in))
                    {   
                        $_SESSION['avail']=false;
                        header('location:addsched.php');
                    }
                    else if (($time_in_f <= $time_out AND $time_out_f >= $time_out))
                    {   
                        $_SESSION['avail']=false;
                        header('location:addsched.php');
                    }    
                    else if (($time_in_f >= $time_in AND $time_out_f <= $time_out))
                    {   
                        $_SESSION['avail']=false;
                        header('location:addsched.php');
                    } 
                    else
                    {
                        $_SESSION['avail']=true;
                        header('location:addsched.php');
                    }
                }
                else
                {
                    $_SESSION['avail']=true;
                    header('location:addsched.php');
                }
            }
            else
            {
                $_SESSION['avail']=true;
                header('location:addsched.php');
            }

?>