<?php
session_start();

?>
<html><head><title>Add New Schedule</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
     <link rel="stylesheet" href="mika/about.css" type="text/css">
     
<style>
    .container{
        width: 50%;
        background: #000033;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
        border-radius: 10px;
        margin-top: 2%;
        height: 93%;
    }

    .child{
        width: 50%;
        margin: 0 auto;
        margin-top: 5%;
        padding: 20px;
        display: flex;
        flex-flow: column;
         padding-top: 5px;
    }
    .btn{
        width: 100%;
    }
    label{
        color: #fff;
    }
</style>
<script type="text/javascript">
     window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
    </script>
</head>
<body>
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

?>

<div class="container">
        <form class="form_container" name="addsched" method="post">
            <div class="child">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtrid">Room Number</label>
                    <SELECT class="form-control" id="txtrid" NAME="txtrid">
                        <?php
                        $SQL = "SELECT * FROM tbl_roomlist";
                        $res = mysqli_query($con, $SQL);
                        $i = -1;
                        while($row = mysqli_fetch_array($res))
                        {
                            $i++;
                            $col[$i]['room_id']=$row['room_id'];

                        }       
                        for ($j=0;$j<=$i;$j++){
                        ?>
                        <OPTION><?php echo $col[$j]['room_id'];
                        }
                            ?>
                        
                    </SELECT>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <?php
                    include 'connect.php';
                    $SQL ="SELECT * FROM accounts WHERE Acc_Uname='".$_SESSION['username']."'";
                    $res = mysqli_query($con, $SQL);
                    $row= mysqli_fetch_array($res);
                    ?>
                    <label for="txteid">Employee ID</label>
                    <input class="form-control" id="txteid" name="txteid" value=<?php echo $row['Employee_ID'];?>  readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtti">Time In</label>
                     <input class="form-control" type="time" name="txtti" value="<?php echo $_SESSION['utimein'];?>" id="txtti">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtto">Time Out</label>
                   <input class="form-control" type="time" name="txtto" value="<?php echo $_SESSION['utimeout'];?>" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtd">Date</label>
                    <input class="form-control" type="date" name="txtd" value="<?php echo $_SESSION['udate'];?>" id="txtd">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <?php
                        $random = rand(10000,99999); 
                    ?>
                    <label for="txtuc">Unique Code</label>
                    <input class="form-control" id="txtuc" name="txtuc" value=<?php echo $random;?>  readonly>
                    
                </div>
            </div>
            <div class="form-group row">
                <?php 
                if ($_SESSION['uerror'] != 'avail'){ ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Check Availability" formaction="checkavail_user.php">
                <?php }
                else if ($_SESSION['uerror'] == 'avail'){
                
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room Available.")';
                echo '</script>';  
                ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save" formaction="add_user.php">
                <?php }?>
                </div>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="reset" value="Clear">
                </div>
            </div>
            </div>
        </form>

</div>
        <?php
            if ($_SESSION['uerror']== 'wrongdate'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of date.")';
                echo '</script>'; 
                $_SESSION['uerror']='no';
                }
            else if ($_SESSION['uerror']== 'wrongtime'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of time.")';
                echo '</script>'; 
                $_SESSION['uerror']='no';
                }
            else if ($_SESSION['uerror']== 'notavail'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room not available. Input another room or time and date")';
                echo '</script>'; 
                $_SESSION['uerror']='no';
                }
                ?>

</body>
</html>