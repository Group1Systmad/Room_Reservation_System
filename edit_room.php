<?php
  
        $rid = $_GET['SID'];
  

  include 'connect.php';

   $SQL = "SELECT * FROM tbl_roomlist WHERE room_id = '$rid'";
   $result = mysqli_query($con,$SQL); //rs.open sql,con

   

   while ($row = mysqli_fetch_assoc($result))
     {
     	$rname = $row["room_name"];
     	$rbldg = $row["room_bldg"];
     	$rfloor = $row["room_floor"];
     	$macaddr = $row["mac_address"];
     }
?>
<html>
<head>
<title>Edit Record</title>
</head>
<body>
<center>
<form NAME="edit_room" METHOD="POST" ACTION="update_rooms.php">
<table BORDER=1 WIDTH=25%>
	<tr>
		<td COLSPAN=2 ALIGN="CENTER">Edit Record</td>
	</tr>

	<tr>
		<td>Room ID:</td>
		<td><input TYPE="text" NAME="roomid" ID="roomid" VALUE="<?php echo $rid; ?>"></td>
	</tr>
        <tr>
		<td>Room Name:</td>
		<td><input TYPE="text" NAME="roomname" ID="roomname" VALUE="<?php echo $rname; ?>"></td>
	</tr>
        <tr>
		<td>Room Building:</td>
		<td><input TYPE="text" NAME="roombldg" ID="roombldg" VALUE="<?php echo $rbldg; ?>"></td>
	</tr>
        <tr>
		<td>Room Floor:</td>
		<td><input TYPE="text" NAME="roomfloor" ID="roomfloor" VALUE="<?php echo $rfloor; ?>"></td>
	</tr>
        <tr>
		<td>MAC Address:</td>
		<td><input TYPE="text" NAME="macaddr" ID="macaddr" VALUE="<?php echo $macaddr; ?>"></td>
	</tr>
	<tr>
		<td COLSPAN=2 ALIGN="CENTER">
		<input TYPE="Submit" VALUE="Update">
		<input TYPE="hidden" ID="hid" NAME="hid" VALUE="<?php echo $rid; ?>">
		</td>
	</tr>

</table>
</form>
</center>
</body>
</html>

