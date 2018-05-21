<?php
session_start();
if ($_SESSION['login_name']== '')
{
    header('location:login_page.php');
}
?>
<html>
<head>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
<!--    <link rel="stylesheet" href="bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
<title>Add New Room</title>
<style>
    .table{
        width: 30%;
        margin: 0 auto;
    }
    .container{
        width: 40%;
        background: #27698d;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
        border-radius: 10px;
    }
    .child{
        width: 70%;
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
    .headers{
        text-align: center;
        font-size: medium;
    }
    td{
        font-size: small;
    }
    .glyphicon-remove{
        color: #ff572d;
        font-size: medium;
    }
    .glyphicon-pencil,.glyphicon-floppy-disk{
        font-size: medium;
    }
    .table_cell{
        background: transparent;
        border: none;
        text-align: center;
    }
    <?php echo ($_SESSION["count"]==2) ? $_SESSION["classname"].'{background:white;border:1px solid;}' : ''?>
    #room_id{
        width: 50px;
    }
    #emp_id{
        width: 80px;
    }
    .save{
        padding: 0 0;

    }
</style>
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
             document.getElementById("myAccountnav").style.border = "1px solid black";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementById("myAccountnav").style.border = "none";
}
</script>
</head>
<body>

<?php
if (isset($_SESSION["count"])){
    echo "Count: ".$_SESSION["count"];
    echo "Selected ".$_SESSION["selected"];
}else{
    echo "Session is not set";
}
?>

<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><div class="selected"><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></div></li>
    </ul>
</div>
    
<div class="container">
        <form class="form_container" name="addroomlist" method="post" action="addroom.php">
            <div class="child">    
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="txtrid">Room ID:</label>
                    <input class="form-control" type="text" name="txtrid" id="txtrid" placeholder="Room Number">
                </div>
            </div>
            <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room Name</label>
                            <input class="form-control" TYPE="text" NAME="roomname" ID="roomname">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room Building</label>
                            <input class="form-control" TYPE="text" NAME="roombldg" ID="roombldg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Room Floor</label>
                            <input class="form-control" TYPE="text" NAME="roomfloor" ID="roomfloor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">MAC Address</label>
                            <input class="form-control" TYPE="text" NAME="macaddr" ID="macaddr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Opening Time</label>
                            <input class="form-control" TYPE="time" NAME="timeframe_in" ID="timeframe_in">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="roomid">Closing Time</label>
                            <input class="form-control" TYPE="time" NAME="timeframe_out" ID="timeframe_out">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                          <input TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $rid; ?>">
                        </div>
                    </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <?php
                    $_SESSION['type'] = 'admin';
                    ?>
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="submit" value="Cancel">
                </div>
                
            </div>
        </form>

</div> 
            
</div> 
            <?php
        if ($_SESSION['same']==true){
            echo '<script type="text/javascript" language="JavaScript">';
            echo 'alert("Room already exists. Input another room ID")';
            echo '</script>';
            $_SESSION["same"] = false;
        }
    ?>
</body>
</html>