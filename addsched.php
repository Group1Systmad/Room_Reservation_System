<html><head><title>Add New Schedule</title>
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
        <li><a href="#"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-list"></span><span class="menu_label">Manage</span></a></li>
    </ul>
</div>

<div class="container">
        <form class="form_container" name="addsched" method="post" action="add.php">
            <div class="child">
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="text" name="txtrid" id="txtrid" placeholder="Room Number">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="text" name="txteid" id="txteid" placeholder="Employee ID">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="time" name="txtti" id="txtti">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="time" name="txtto" id="txtto">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="date" name="txtd" id="txtd">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <input class="form-control" type="text" name="txtuc" id="txtuc">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input class="btn btn-primary" type="submit" value="Save">
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