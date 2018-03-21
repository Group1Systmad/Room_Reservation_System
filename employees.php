<?php
session_start();

?>
<HTML>
<HEAD>
<TITLE>List of Employees</TITLE>
<SCRIPT TYPE="text/javascript">
	function Del()
	  {
	     var confirmDel = confirm("Are you sure?");

	     if (confirmDel==true)//the user pressed the ok button
	     {
	     	return true;
	     }
	     else
	     {
	     	return false;
	     }
	  }
</SCRIPT>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <style>
        .table{
            width: 20%;
            margin: 0 auto;
        }
        .container{
            margin-top: 10%;
            text-align: center;

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
        .form-control{
            height: 25px;
        }
        .search_button{
            padding: 2px 10px;
        }
        .table_cell{
            background: transparent;
            border: none;
        }
        #emp_id,#emp_age,#emp_dept,#emp_cnumber{
            width: 100%  ;
        }
        #gender {
            width: 100%;
        }
        <?php echo ($_SESSION["count"]==2) ? $_SESSION["classname"].'{background:white;border:1px solid;}' : ''?>
    </style>
</HEAD>
<BODY>

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

    <FORM class="form-inline" NAME="searchArea" METHOD="POST" ACTION="">
                <div class="form-group">
                    <Label>Search by Last name:</Label>
                    <INPUT class="form-control form-control-xs mb-2 mr-sm-2" TYPE="text" ID="txtSearchLN" NAME="txtSearchLN">
                </div>
        <INPUT class="btn btn-primary search_button" TYPE="submit" VALUE=" Search ">
    </FORM>

    <TABLE class="table">
        <TR class="headers">
            <TD>Remove</TD>
            <TD>Edit</TD>
            <TD>ID Number</TD>
            <TD>Last Name</TD>
            <TD>First Name</TD>
            <TD>Address</TD>
            <TD>Age</TD>
            <TD>Department</TD>
            <TD>Email</TD>
            <TD id="gender_header">Gender</TD>
            <TD>Contact&nbsp;Number&nbsp;</TD>
        </TR>
        <?php
        include 'connect.php';

        if (!isset($_POST['txtSearchLN']))
        {
            $_POST['txtSearchLN'] = "undefined";
        }

        $searchLN = $_POST['txtSearchLN'];

        if ($searchLN=="undefined")
        {
            $SQL = mysqli_query($con,"SELECT * FROM employee ORDER BY Emp_LN");

        }
        else
        {
            $SQL=mysqli_query($con,"SELECT * FROM employee WHERE Emp_LN LIKE '$searchLN%'");
        }
        while($row=mysqli_fetch_array($SQL))
        {
        ?><!--end of first php -->
        <form <?php echo ($_SESSION["count"]==2) ? 'method=\'post\' action=\'employee_edit.php\'' : '' ?>>
        <TR>
<!--            <TD ALIGN="CENTER"><a onclick="return Del()" href="delete_employee.php?SID=--><?php //echo $row['Employee_ID']; ?><!--"><span class="glyphicon glyphicon-remove"></span></a></TD>-->
<!--            <TD ALIGN="CENTER"><a href="editrec.php?SID=--><?php //echo $row['Employee_ID']; ?><!--"><span class="glyphicon glyphicon-pencil"></span></a></TD>-->
<!--            <TD>--><?php //echo $row['Employee_ID']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_LN']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_FN']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_Address']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_Age']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_Department']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_Email']; ?><!--</TD>-->
<!--            <TD>--><?php //echo $row['Emp_Gender']; ?><!--</TD>-->
            <td align="center"><a onclick="return Del()" href="delete_employee.php?SID=<?php echo $row['Employee_ID']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
            <!--                <td align="center"><a href="editsched.php?SID=--><?php //echo $row['id']; ?><!--"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
            <td align="center"><a href="employee_edit.php?SID=<?php echo $row['Employee_ID']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                    echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$row['Employee_ID']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                    ?></a></td>
            <!--                <td>--><?php //echo $row['id']; ?><!--</td>-->
            <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_id" id="emp_id" value=<?php echo $row['Employee_ID']; ?> readonly></td>
            <td><input class="<?php echo 'cell'.$row['Employee_ID']?> table_cell" name="emp_ln" id="emp_ln" value=<?php echo $row['Emp_LN']; ?> <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>> </td>
            <td><input class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" name="emp_fn" id="emp_fn" value=<?php echo $row['Emp_FN']; ?>  <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" id="emp_add" name="emp_add" value="<?php echo $row['Emp_Address']; ?>"  <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" id="emp_age" name="emp_age" value=<?php echo $row['Emp_Age']; ?>  <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" id="emp_dept" name="emp_dept" value=<?php echo $row['Emp_Department']; ?>  <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="email" class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" id="emp_email" name="emp_email" value=<?php echo $row['Emp_Email'];?>  <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><select class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" id="gender" name="gender">
                    <option value="Female" <?php echo ($row['Emp_Gender']=="Female") ? "selected":"";?> <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "disabled=\"disabled\"" : ""?>>F</option>
                    <option value="Male"  <?php echo ($row['Emp_Gender']=="Male") ? "selected":"";?> <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "disabled=\"disabled\"" : ""?>>M</option>
                </select>
            </td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$row['Employee_ID']?>" id="emp_cnumber" name="emp_cnumber" value=<?php echo $row['Emp_CNumber']; ?>  <?php echo (($_SESSION["count"]==2 && $row['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
        </TR>
        </form>
        <?php //open of second php
        }//close of while
        mysqli_close($con);
        ?><!-- close of second php -->
    </TABLE>
    <a href="addemp.php"><button class="btn btn-primary">Add another employee</button></a>

    <font size="4" face="arial"  color="blue">
        <?php
        include 'connect.php';

        $result = mysqli_query($con,"SELECT * FROM employee ");
        $rows = mysqli_num_rows($result);
        echo "<br>";
        echo "There are " . $rows . " record(s) in the table. ";
        mysqli_close($con);
        ?>
    </font>
    <br></br>
</div>





</BODY>
</HTML>
