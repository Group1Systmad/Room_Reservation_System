<?php
session_start();
if(!isset($_SESSION['eid'])){
    $_SESSION['eid']="";
}
if(!isset($_SESSION['rid'])){
    $_SESSION['rid']="";
}
if(!isset($_SESSION['timein'])){
    $_SESSION['timein']="";
}
if(!isset($_SESSION['timeout'])){
    $_SESSION['timeout']="";
}
if(!isset($_SESSION['date'])){
    $_SESSION['date']="";
}
if(!isset($_SESSION['avail'])){
    $_SESSION['avail']=false;
}
?>
<html>
    <head>
        <title>Add New Schedule</title>
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
        
</script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    

<style>
    .container{
        width: 50%;
        background: #27698d;
        margin: 0 auto;
        margin-top: 10%;
        padding: 20px;
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
</style>
</head>
<body>

<div class="sidebar">
    <ul>
       <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-info-sign"></span><span class="menu_label">About</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a onclick="return logout()" href="login_page.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Log Out</span></a></li>
    </ul>
</div>

<div class="container">
        <form class="form_container" name="addsched" method="post">
            <div class="child">    
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="text" name="txtrid" value="<?php echo $_SESSION['rid'];?>" id="txtrid" placeholder="Room Number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="text" name="txteid" value="<?php echo $_SESSION['eid'];?>" id="txteid" placeholder="Employee ID" required="true">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="time" name="txtti" value="<?php echo $_SESSION['timein'];?>" id="txtti">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="time" name="txtto" value="<?php echo $_SESSION['timeout'];?>" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="date" name="txtd" value="<?php echo $_SESSION['date'];?>" id="txtd">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">

                    <?php
                        $random = rand(10000,99999); 
                    ?>
                    <input class="form-control" id="txtuc" name="txtuc" value=<?php echo $random;?>  readonly>
                    
                </div>
            </div>
            <div class="form-group row">
                <?php
                if ($_SESSION['avail']==false){
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room not Available. Input another room or time and date")';
                echo '</script>';    
                ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Check Availability" formaction="checkavail.php">
                <?php }
                else if ($_SESSION['avail']==true){
                
                $_SESSION['eid']="";
                $_SESSION['rid']="";
                $_SESSION['timein']="";
                $_SESSION['timeout']="";
                $_SESSION['date']="";
                $_SESSION['avail']=false;
                
                echo '<script type="text/javascript" language="JavaScript">';
                echo 'alert("Room Available.")';
                echo '</script>';  
                ?>
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save" formaction="add.php">
                <?php }?>
                </div>
                <div class="col-md-6">
                    <input class="btn btn-danger" type="reset" value="Clear">
                </div>
            </div>
            </div>
        </form>

</div>


</body>
</html>