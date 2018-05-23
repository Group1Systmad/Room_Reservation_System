<?php
            session_start();
            include 'connect.php';
            $oldpass = $_POST['opword'];
            $newpass = $_POST['npword'];
            $cnpass = $_POST['cnpword'];
            $user = $_POST['uname'];
            $SQL = "SELECT * FROM accounts WHERE Acc_Uname='$user'";
            $res = mysqli_query($con, $SQL);
            $count = mysqli_num_rows($res);
            if ($count == 0)
            {   
                mysqli_close($con);
                $_SESSION["username_ch"] = 0;
                header('location:change_pass.php');
            }
            else
            {
                $SQL = "SELECT * FROM accounts WHERE Acc_Pass='$oldpass'";
                $res = mysqli_query($con, $SQL);
                $count = mysqli_num_rows($res);
                if ($count == 0)
                {   
                    mysqli_close($con);
                    $_SESSION['cperror'] = 'oldpass';
                    header('location:change_pass.php');
                }
                else
                {
                    $SQL = "SELECT * FROM accounts WHERE Acc_Pass='$newpass' AND Acc_Uname='$user'";
                    $res = mysqli_query($con, $SQL);
                    $count = mysqli_num_rows($res);
                    if ($count == 1)
                    {   
                        mysqli_close($con);
                        $_SESSION['cperror'] = 'newpass';
                        header('location:change_pass.php');
                    }
                    else
                    {
                        if ($cnpass != $newpass)
                        {   
                            $_SESSION['cperror'] = 'cnpass';
                            header('location:change_pass.php');
                        }
                        else
                        {
                        $SQL = "UPDATE accounts SET Acc_Pass='$newpass',count='0' WHERE Acc_Uname='$user'";
                        $res = mysqli_query($con, $SQL);
                        mysqli_close($con);
                        $_SESSION['changed'] = 1;
                        header('location:login_page.php');
                        }            
                    }
                }
            }

?>