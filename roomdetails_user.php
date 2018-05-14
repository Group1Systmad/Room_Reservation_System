<?php
session_start();
$rid = $_POST['txtrid'];

?>
<html>
    <head>
        <title>View Room Details</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
     <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/aboutus.css" type="text/css">

<style>
    .container{
        width: 100%;
        background: #fff;
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
     * {box-sizing: border-box;}
    
    .portrait{
                margin: 0 auto;
                text-align: center;
                width: 100%;
                position: absolute;
                padding-bottom: 50px;
            }
            
            .imgcont{
                position: relative;
                margin: auto;
                padding-top: 90px;
                width:200px;
                }
            
            .cover{
                width: 100%;
                height: 150px;
                background: #1b6d85;
                
            }
            .cover-container{
                position: relative;
                margin-bottom: 100px; 
                margin-top: -20px;
            }
            .user-identity{
                text-align: center;
            }
            .userfullname{
                text-transform: uppercase;
                font-weight: 500;
            }
            .half{
                
                background: #f7f7f7;
                padding: 20px;
                border: 2px solid white;
            }
            .table{
                margin-top: 20px;
                border: 1px solid #e4e4e4;
            }
            .table td{
                background: #fff;
            }
            .change-pass-link{
                text-align: right;
                margin-left: 50px;
            }
            #account_type{
                text-transform: capitalize;
            }
            .overlay {
            position:absolute;
            width: 200px;
            border-radius: 0 0 200px 200px;
            height: 100px;
            bottom:0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            color: #f1f1f1; 
            padding:20px;
            transition: .5s ease;
            opacity:0;
            color: white;
            font-size: 15px;
            padding-top: 50px;
            }

            .imgcont:hover .overlay {
            opacity: 1;
}
</style>
</head>
<body>
        <?php
        //code here to get data from database using $rid;
        include 'connect.php';
        $SQL = "SELECT * FROM tbl_roomlist WHERE room_id='$rid'";
        $res = mysqli_query($con, $SQL);
        $row = mysqli_fetch_array($res);
        
        ?>
    
    
      <div class="container">
          <div class="row">
              <div class="col-md-3 half">
                  <a href="addsched_user.php"><button class="btn btn-primary">Back</button></a>
              </div>
          </div>
            <div class="row">
                <div class="col-md-6 half">
                Location
                <table class="table">
                    <tr>
                        <td>Room Name:</td>
<!--                        replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['room_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Room Bldg:</td>
                        <!--  replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['room_bldg']; ?></td>
                    </tr>
                    <tr>
                         <td>Room Floor</td>
                         <!--  replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['room_floor']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 half">
                Features
                <table class="table">
                    <tr>
                        <td>Amenities</td>
                        <!--  replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['Amenities']; ?></td>
                    </tr>
                </table>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 half">
                   Accommodation
                    <table class="table">
                        <tr>
                        <td>Max Pax</td>
                        <!-- replace code below to get data from a variable stored when the system connected-->
                        <td><?php echo $row['Pax']; ?></td>
                        </tr>
                    </table>
                    
                </div>
               
            </div>
        </div>
    
    
    
    
</body>
</html>