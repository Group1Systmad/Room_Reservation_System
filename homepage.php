<?php
session_start();
?>
<html>
<head>
    <title>Home Page</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <style>
        .jumbotron{
            margin-top: 5%;
        }
        .overview_active{
            width: 25%;
            height: 35%;
            background: #ff7a24;
            color: #fff;
            padding: 40px 20px 10px 20px;
            text-align: center;
            padding-top:40px;
            margin-top: 0;
        }
        .page-footers{
            text-align: center;
            margin: 0 auto;
            font-size: medium;
            padding-top: 10px;
            display: inline-block;

        }
        .pages{
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #2B2B2B;
            margin: 0 4px;
        }
        .center{
            text-align: center;
        }
        .curPage {
            background-color: #ff7a24;
            color: white;
            border: 1px solid #ff7a24;
        }
        .table_view{
            height: 100%;
        }
    </style>
</head>

<body>
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

?>
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
    <div class="jumbotron">
<!--Edit Mar-->
        <h1>Room Reservation App</h1>
        <p>Together with the Smart Reservation Tool (SMART), you can have no worries in booking reservations for a specific room in your organization.</p>
        <p>Just click <a href="#">here</a> to reserve!</p>
    </div>
    <div class="row">
        <div class="jumbotron overview_active col-md-3">
            <h1>
                <?php
                include 'connect.php';
                $result = mysqli_query($con,"SELECT * FROM tbl_sched WHERE Status='1'");
                $rows = mysqli_num_rows($result);
                echo $rows . "/10 ";
                mysqli_close($con);
                ?>
            </h1>
<!--            Comment-->
            <p>rooms are reserved</p>
        </div>
        <div class="table_view col-md-9">
            <table class="table">
                <tr class="headers">
                    <td>Room ID</td>
                    <td>Employee ID</td>
                    <td>Time In</td>
                    <td>Time Out</td>
                    <td>Date</td>
                    <td>Status</td>
                </tr>
                <!--                dito niyo lagay yung magdidisplay ng ACTIVE reserved na reservations-->
                <?php
                include 'connect.php';
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                $results_per_page = 4   ;
                $start_from = ($page-1) * $results_per_page;
                $SQL ="SELECT * FROM tbl_sched WHERE Status = '1' ORDER BY id LIMIT $start_from, ".$results_per_page;
                $res = mysqli_query($con, $SQL);
                while($row= mysqli_fetch_array($res)){
                ?><!--end of first php -->
                <tr>
                    <td><?php echo $row['room_id']; ?></td>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['time_in']; ?></td>
                    <td><?php echo $row['time_out']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo "ACTIVE"; ?></td>
                </tr>

                <?php //open of second php

                }//close of while
                mysqli_close($con);

                ?><!-- close of second php -->
            </table>
            <!--            dito niyo ilagay yung part na magnenext-->

            <div class="center">
                <div class="page-footers">

                    <?php
                    include 'connect.php';
                    $sql = "SELECT COUNT(id) AS total FROM tbl_sched WHERE Status=1";
                    $res = mysqli_query($con, $sql);
                    $row= mysqli_fetch_array($res);
                    $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
			//Edit ni Marj 123
                    for ($i=1; $i<=$total_pages; $i++) {
                        echo "<a class='pages";
                        echo ($i==$page) ? ' curPage\'' : '\'';
                        echo " href='homepage.php?page=".$i."'";

                        echo ">".$i."</a> ";
                    };
                    ?>
                </div>
            </div>


        </div>
    </div>

</body>

</html>