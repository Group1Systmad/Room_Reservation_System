<?php
  $ID = $_GET['SID'];

  include 'connect.php';

   $SQL = "SELECT * FROM tbl_sched WHERE id='$ID'";
   $result = mysqli_query($con,$SQL);

   $num = mysqli_num_rows($result); //recordcount

   while($num = mysqli_fetch_assoc($result)) {
        $roomid = $num['room_id'];
     	$empid = $num['emp_id'];
     	$ti = $num['time_in'];
     	$to = $num['time_out'];
     	$date = $num['date'];
        $ucode = $num['u_code'];
}
?>
<HTML>
<HEAD>
<TITLE>Edit Schedule</TITLE>
</HEAD>
<BODY>
<CENTER>
<FORM NAME="editsched" METHOD="POST" ACTION="update__reservation.php">
<TABLE BORDER=1 WIDTH=25%>
	<TR>
		<TD COLSPAN=2 ALIGN="CENTER">Edit Schedule</TD>
	</TR>

	<TR>
		<TD>Reservation ID:</TD>
		<TD><?php echo $ID; ?></TD>
	</TR>
	<TR>
		<TD>Room ID:</TD>
		<TD><INPUT TYPE="text" NAME="txtrid" ID="txtrid" VALUE="<?php echo $roomid; ?>"></TD>
	</TR>
	<TR>
		<TD>Employee ID:</TD>
		<TD><INPUT TYPE="text" NAME="txteid" ID="txteid" VALUE="<?php echo $empid; ?>"></TD>
	</TR>
	<TR>
		<TD>Time In:</TD>
		<TD><INPUT TYPE="time" NAME="txtti" ID="txtti" VALUE="<?php echo $ti; ?>"></TD>
	</TR>
	<TR>
		<TD>Time Out:</TD>
		<TD><INPUT TYPE="time" NAME="txtto" ID="txtto" VALUE="<?php echo $to; ?>"></TD>
	</TR>
	<TR>
		<TD>Date:</TD>
		<TD>
		<INPUT TYPE="date" NAME="txtd" ID="txtd" VALUE="<?php echo $date; ?>">
		</TD>
	</TR>
        <TR>
		<TD>Unique Code:</TD>
		<TD><?php echo $ucode; ?></TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ALIGN="CENTER">
		<INPUT TYPE="Submit" VALUE="Update">
		<INPUT TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $ID; ?>">
		</TD>
	</TR>

</TABLE>
</FORM>
</CENTER>
</BODY>
</HTML>