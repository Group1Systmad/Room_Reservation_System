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
            $i = -1;
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
                        $_SESSION['avail']=false;
                        header('location:addsched.php');
                        $j=$i;
                        }
                        else if (($time_in_f <= $time_out AND $time_out_f >= $time_out))
                        {   
                        $_SESSION['avail']=false;
                        header('location:addsched.php');
                        $j=$i;
                        }    
                        else if (($time_in_f >= $time_in AND $time_out_f <= $time_out))
                        {   
                        $_SESSION['avail']=false;
                        header('location:addsched.php');
                        $j=$i;
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
            }
            else
            {
            $_SESSION['avail']=true;
            header('location:addsched.php');
            }
           
            
            

mysqli_close($con);
?>