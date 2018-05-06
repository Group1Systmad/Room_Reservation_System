<?php
    include 'connect.php';
    $sid = $_GET['SID'];
    
    $SQL = " SELECT tbl_sched.id,tbl_sched.room_id,tbl_sched.emp_id,tbl_sched.time_in,tbl_sched.time_out,tbl_sched.date,
            tbl_sched.u_code,tbl_sched.Status,tbl_roomlist.room_name,tbl_roomlist.room_bldg,tbl_roomlist.room_floor,
            tbl_roomlist.Amenities,tbl_roomlist.Pax,tbl_roomlist.Room_Status,employee.Employee_ID,employee.Emp_FN,
            employee.Emp_LN,employee.Emp_Department,employee.Emp_CNumber,employee.Emp_Email 
            FROM tbl_sched,tbl_roomlist,employee WHERE tbl_sched.room_id = tbl_roomlist.room_id
            AND tbl_sched.emp_id = employee.Employee_ID AND tbl_sched.id = '$sid'";
    
    $result = mysqli_query($con, $SQL);
    
    while ($row = mysqli_fetch_assoc($result)){
        $reservation_id = $row['id'];
        $room_id = $row['room_id'];
        $emp_id = $row['emp_id'];
        $time_in = $row['time_in'];
        $time_out = $row['time_out'];
        $date = $row['date'];
        $u_code = $row['u_code'];
        $reservation_status = $row['Status'];
        $room_name = $row['room_name'];
        $room_bldg = $row['room_bldg'];
        $room_floor = $row['room_floor'];
        $amenities = $row['Amenities'];
        $pax = $row['Pax'];
        $room_status = $row['Room_Status'];
        $emp_fn = $row['Emp_FN'];
        $emp_ln = $row['Emp_LN'];
        $emp_dept = $row['Emp_Department'];
        $emp_cnumber = $row['Emp_CNumber'];
        $emp_email = $row['Emp_Email'];
    }
    
    
    

?>

<html>
    <head>
        <title>Reservation Details</title>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
        <style>
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
        
        <div class="container">
            <div class="row">
                <div class="col-md-6 half">
                Reservation Details
                <table class="table">
                    <tr>
                        <td>Reserved Room: </td>
                        <td><?php echo $room_name?></td>
                    </tr>
                    <tr>
                        <td>Starting Time:</td>
                        <td><?php echo $time_in?></td>
                    </tr>
                    <tr>
                         <td>End Time:</td>
                        <td><?php echo $time_out?></td>
                    </tr>
                    <tr>
                        <td>Date:</td>
                        <td><?php echo $date?></td>
                    </tr>
                    <tr>
                        <td>Unique Code:</td>
                        <td><?php echo $u_code?></td>
                    </tr>
                      <tr>
                        <td>Status :</td>
                        <td><?php 
                            if($reservation_status == 0){
                                echo "INACTIVE";
                            }
                            else{
                                echo "ACTIVE";
                            }
                                
                        ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 half">
                Reservee Details
                <table class="table">
                    <tr>
                        <td>Employee Number</td>
                        <td><?php echo $emp_id?></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $emp_fn?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $emp_ln?></td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td><?php echo $emp_dept?></td>
                    </tr>
                </table>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6 half">
                   Room Details
                    <table class="table">
                        <tr>
                            <td>Room Number</td>
                            <td><?php echo $room_id?></td>
                        </tr>
                        <tr>
                            <td>Room Building</td>
                            <td><?php echo $room_bldg?></td>
                        </tr>
                        <tr>
                            <td>Room Floor</td>
                            <td id="account_type"><?php echo $room_floor?></td>
                        </tr>
                        <tr>
                            <td>Amenities</td>
                            <td id="account_type"><?php echo $amenities?></td>
                        </tr>
                        <tr>
                            <td>PAX</td>
                            <td id="account_type"><?php echo $pax?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 half">
<!--                    Cancel button must appear if the reservation status is Active-->
<!--                    Delete Alert Pop up before deleting-->
                    <a href="cancelreservation.php"><button class="btn btn-danger">Cancel Reservation</button></a>
                </div>
            </div>
        </div>
        
        
        
    </body>
</html>