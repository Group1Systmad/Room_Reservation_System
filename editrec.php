<?php


	$StudentID = $_GET['SID'];

  include 'connect.php';

   $SQL = "SELECT * FROM employee WHERE Employee_ID='$StudentID'";
   $result = mysqli_query($con,$SQL); //rs.open sql,con

   

   while ($row = mysqli_fetch_assoc($result))
     {
     	$ln = $row["Emp_LN"];
     	$fn = $row["Emp_FN"];
     	$add = $row["Emp_Address"];
     	$age = $row["Emp_Age"];
        $dept = $row["Emp_Department"];
        $email = $row["Emp_Email"];
     	$gend = $row["Emp_Gender"];
     }
?>
<HTML>
<HEAD>
<TITLE>Edit Record</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="editrec" METHOD="POST" ACTION="update_employee.php">
<TABLE BORDER=1 WIDTH=25%>
	<TR>
		<TD COLSPAN=2 ALIGN="CENTER">Edit Record</TD>
	</TR>

	<TR>
		<TD>ID Number:</TD>
		<TD><?php echo $StudentID; ?></TD>
	</TR>
	<TR>
		<TD>Last Name:</TD>
		<TD><INPUT TYPE="text" NAME="txtLN" ID="txtLN" VALUE="<?php echo $ln; ?>"></TD>
	</TR>
	<TR>
		<TD>First Name:</TD>
		<TD><INPUT TYPE="text" NAME="txtFN" ID="txtFN" VALUE="<?php echo $fn; ?>"></TD>
	</TR>
	<TR>
		<TD>Address:</TD>
		<TD><INPUT TYPE="text" NAME="txtAddress" ID="txtAddress" VALUE="<?php echo $add; ?>"></TD>
	</TR>
	<TR>
		<TD>Age:</TD>
		<TD><INPUT TYPE="text" NAME="txtAge" ID="txtAge" VALUE="<?php echo $age; ?>"></TD>
	</TR>
        <TR>
		<TD>Department:</TD>
		<TD><INPUT TYPE="text" NAME="txtDepartment" ID="txtDepartment" VALUE="<?php echo $dept; ?>"></TD>
	</TR>
        <TR>
		<TD>Email:</TD>
		<TD><INPUT TYPE="text" NAME="txtEmail" ID="txtEmail" VALUE="<?php echo $email; ?>"></TD>
	</TR>
	<TR>		
                <TD>Gender:</TD>
		<TD>
			<SELECT NAME="txtG" ID="txtG" VALUE="<?php echo $gend; ?>">
				<OPTION>Male
				<OPTION>Female
			</SELECT>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ALIGN="CENTER">
		<INPUT TYPE="Submit" VALUE="Update">
		<INPUT TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $StudentID; ?>">
		</TD>
	</TR>

</TABLE>
</FORM>
</CENTER>
</BODY>
</HTML>

