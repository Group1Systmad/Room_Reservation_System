<?php
session_start();

?>
<html>
    <head>
        <title>Add New Schedule</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
     <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/aboutus.css" type="text/css">
<script type="text/javascript">
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

</script>
<style>
    .container{
        width: 100%;
        background: #27698d;
        margin: 0 auto;
        margin-top: 10%;
        padding: 5px;
        border-radius: 10px;
    }

    .child{
        width: 50%;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
        display: flex;
        flex-flow: column;
    }
    .btn{
        width: 100%;
    }
    label{
        color: #fff;
    }
    #popup{
        margin: 0;
    }
</style>
</head>
<body>

    <div class="container" id="popup">
        <form class="form_container" name="addsched" method="post">
            <div class="child">    
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtrid">Room Number</label>
                    <SELECT class="form-control" id="txtrid" NAME="txtrid">
                        <?php
                        include 'connect.php';
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
                <div class="col-md-6">
<!--                    <a href = "roomdetails.php"><button class="btn btn-primary">Room Details</button>></a>-->
                    <input class="btn btn-primary" type="submit" value="Room Details" formaction="roomdetails.php">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txteid">Employee ID</label>
                    <input class="form-control" type="text" name="txteid" value="<?php echo $_SESSION['eid'];?>" id="txteid" placeholder="Employee ID" required="true" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtti">Time In</label>
                    <input class="form-control" type="time" name="txtti" value="<?php echo $_SESSION['timein'];?>" id="txtti">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtto">Time Out</label>
                    <input class="form-control" type="time" name="txtto" value="<?php echo $_SESSION['timeout'];?>" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtd">Date</label>
                    <input class="form-control" type="date" name="txtd" value="<?php echo $_SESSION['date'];?>" id="txtd">
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
                if ($_SESSION['error'] != 'avail'){ ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Check Availability" formaction="checkavail.php">
                </div>   
                <div class="col-md-6">
                    <input class="btn btn-danger" type="reset" value="Clear">
                </div>   
                <?php }
                else if ($_SESSION['error']=='avail'){
                
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room Available.")';
                echo '</script>';  
                ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save" formaction="add.php">
                </div>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="submit" value="Cancel" formaction="schedtable.php">
                </div>
                <?php }?>
                
            </div>
        </form>

</div>
             <?php
                if ($_SESSION['error']== 'wrongdate'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of date.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'wrongtime'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Wrong input of time.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'wrongrange'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room is not available at that time. Check Rooms for details.")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                else if ($_SESSION['error']== 'notavail'){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room not available. Input another room or time and date")';
                echo '</script>'; 
                $_SESSION['error']='no';
                }
                ?>
            </div>
</body>
</html>