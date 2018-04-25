<?php
session_start();

?>
<HTML>
<HEAD>
<TITLE>List of Employees</TITLE>
<SCRIPT TYPE="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var n= today.getMonth();
    var o= today.getDate();
    if (h>12){h= h-12; }
    h = checkTime(h);
    m = checkTime(m);
    n = n+1;
    n = checkTime(n);
    o = checkTime(o);
     document.getElementById('time').innerHTML =
     h + ":" + m 
     document.getElementById('date').innerHTML =
     n + "/" + o 
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}	
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
             //document.getElementById("myAccountnav").style.border = "1px solid black";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementById("myAccountnav").style.border = "none";
}

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
</SCRIPT>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
       <link rel="stylesheet" href="mika/about.css" type="text/css">
     <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
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
<body onload="startTime()">

      
    <div id="myAccountnav" class="accnav" style="top:70px;">
  <a href="javascript:void(0)" class="closebtn hoverable" onclick="closeaccNav()">&times;</a>
            <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            ?>
           <div class="center"> <img src= "<?php  if (empty($row1['Emp_Photo'])){ echo "Male User_96px.png";} else {echo $row1['Emp_Photo'];}?>" style="border-radius: 100%; max-height: 90px;">
            <div class="name"> <?php echo $row1['Emp_FN']; ?> <?php echo $row1['Emp_LN']; ?> </div>
            <div class="id"> ID Number: <?php echo $row['Employee_ID']; ?> </div>
            <hr>
            <a class="hoverable" href="admin_account.php">Account Info</a> 
            <a class="hoverable" href="change_pass.php">Change Password</a> 
            <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" href="login_page.php">Logout</a></div>
            </div>
</div>
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></li>
        <li><div class="selected"><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></div></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><div id="time" style="padding-top:180px; font-size: 18px; color:white; text-align: center"></div> </li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>
        <li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></li>
    </ul>
</div>
   

<div class="container">
    

    <FORM class="form-inline" NAME="searchArea" METHOD="POST" ACTION="employees.php">
                <div class="form-group">
                    <Label>Search by Last name:</Label>
                    <INPUT class="form-control form-control-xs mb-2 mr-sm-2" TYPE="text" ID="txtSearchLN" NAME="txtSearchLN">
                </div>
        <INPUT class="btn btn-primary search_button" TYPE="submit" VALUE=" Search ">
    </FORM>

    <TABLE class="table">
        <TR class="headers" style="color:#00b3b3">
            <TD>Remove</TD>
            <TD>Edit</TD>
            <TD>IDNumber</TD>
            <TD>LastName</TD>
            <TD>FirstName</TD>
            <TD>Address</TD>
            <TD>Age</TD>
            <TD>Department</TD>
            <TD>Email</TD>
            <TD id="gender_header">Gender</TD>
            <TD>Contact&nbsp;Number&nbsp;</TD>
        </TR>
        <?php
        include 'connect.php';

        if (isset($_POST['txtSearchLN']))
        {
            $_SESSION['current_search'] = $_POST['txtSearchLN'];
            $searchLN = $_SESSION['current_search'];
        }else{
            $_POST['txtSearchLN'] = "undefined";
        }
        if (isset($_SESSION['current_search']))
        {
            $query = "SELECT * FROM employee WHERE Emp_LN LIKE '".$_SESSION['current_search']."%"."'";
            
            $SQL=mysqli_query($con,$query);
           
        }
        else 
        {
             $SQL = mysqli_query($con,"SELECT * FROM employee ORDER BY Emp_LN");
        }
        while($_SESSION['row']=mysqli_fetch_assoc($SQL))
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
            <td align="center"><a onclick="return Del()" href="delete_employee.php?SID=<?php echo $_SESSION['row']['Employee_ID']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
            <!--                <td align="center"><a href="editsched.php?SID=--><?php //echo $row['id']; ?><!--"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
            <td align="center"><a href="employee_edit.php?SID=<?php echo $_SESSION['row']['Employee_ID']; ?>"><<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$_SESSION['row']['Employee_ID']) ? 'button name=\'save_button\' type=submit class="btn btn-link save"' : 'span' ?> class=<?php echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$_SESSION['row']['Employee_ID']) ? "'glyphicon glyphicon-floppy-disk'" : "'glyphicon glyphicon-pencil'"?>><?php
                    echo ($_SESSION["count"]==2 && $_SESSION["selected"]==$_SESSION['row']['Employee_ID']) ? '<span class="glyphicon glyphicon-floppy-disk"></span></button>' : '</span>';
                    ?></a></td>
            <!--                <td>--><?php //echo $row['id']; ?><!--</td>-->
            <td><input class="<?php echo 'cell'.$_SESSION['row']['Employee_ID']?> table_cell" name="emp_id" id="emp_id" value=<?php echo $_SESSION['row']['Employee_ID']; ?> readonly></td>
            <td><input class="<?php echo 'cell'.$_SESSION['row']['Employee_ID']?> table_cell" name="emp_ln" id="emp_ln" value=<?php echo $_SESSION['row']['Emp_LN']; ?> <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>> </td>
            <td><input class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" name="emp_fn" id="emp_fn" value='<?php echo $_SESSION['row']['Emp_FN']; ?>'  <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" id="emp_add" name="emp_add" value="<?php echo $_SESSION['row']['Emp_Address']; ?>"  <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" id="emp_age" name="emp_age" value=<?php echo $_SESSION['row']['Emp_Age']; ?>  <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" id="emp_dept" name="emp_dept" value=<?php echo $_SESSION['row']['Emp_Department']; ?>  <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><input type="email" class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" id="emp_email" name="emp_email" value=<?php echo $_SESSION['row']['Emp_Email'];?>  <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
            <td><select class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" id="gender" name="gender">
                    <option value="Female" <?php echo ($_SESSION['row']['Emp_Gender']=="Female") ? "selected":"";?> <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "disabled=\"disabled\"" : ""?>>F</option>
                    <option value="Male"  <?php echo ($_SESSION['row']['Emp_Gender']=="Male") ? "selected":"";?> <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "disabled=\"disabled\"" : ""?>>M</option>
                </select>
            </td>
            <td><input type="text" class="table_cell <?php echo 'cell'.$_SESSION['row']['Employee_ID']?>" id="emp_cnumber" name="emp_cnumber" value=<?php echo $_SESSION['row']['Emp_CNumber']; ?>  <?php echo (($_SESSION["count"]==2 && $_SESSION['row']['Employee_ID']!=$_SESSION["selected"]) || $_SESSION["count"]<=1) ? "readonly" : ""?>></td>
        </TR>
        </form>
        <?php //open of second php
        }//close of while
        mysqli_close($con);
        ?><!-- close of second php -->
    </TABLE>
    <a onclick="return PopupCenter('addemp.php','Update Profile ','900','500');  "><button class="btn btn-primary"  style="margin-top: 45px; margin-bottom: 20px">Add another employee</button></a>

    <font size="4" face="arial"  color="#ff7a24">
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
