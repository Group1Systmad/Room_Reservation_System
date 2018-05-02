<html>
<head>
<title>Room List</title>
<script TYPE="text/javascript">
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
</script>
</head>
<body>
<center>
<table WIDTH=50% BORDER=1>
	<tr>
		<td COLSPAN=8 ALIGN="CENTER">List of Rooms</td>
	</tr>
	<tr>
		<td COLSPAN=8>
		<form NAME="searchArea" METHOD="POST" ACTION="">
			<label>Search by Room ID:</label>
			<input TYPE="text" ID="txtSearchLN" NAME="txtSearchLN">
                        <input TYPE="submit" VALUE=" Search ">
		</form>
		</td>
	</tr>
	<tr>
                <td>Delete</td>
                <td>Edit</td>
		<td>Room ID</td>
		<td>Room Name</td>
		<td>Room Building</td>
		<td>Room Floor</td>
		<td>MAC Address</td>
                
	</tr>
<?php
include 'connect.php';
 
if (!isset($_POST['txtSearchLN']))
  {
     $_POST['txtSearchLN'] = "undefined";
  }

$searchLN = $_POST['txtSearchLN'];


if ($searchLN=="undefined")
 {
   $SQL = mysqli_query($con,"SELECT * FROM tbl_roomlist ORDER BY room_id");
     
 }
else 
 {
   $SQL=mysqli_query($con,"SELECT * FROM tbl_roomlist WHERE room_id LIKE '$searchLN%'");
 }





 

while($row=mysqli_fetch_array($SQL))
	{
 ?><!--end of first php -->
	<tr>
		<td ALIGN="CENTER"><a onclick="return Del()" href="delete_room.php?SID=<?php echo $row['room_id']; ?>">Delete</a></td>
		<td ALIGN="CENTER"><a href="edit_room.php?SID=<?php echo $row['room_id']; ?>">Edit</a></td>
		<td><?php echo $row['room_id']; ?></td>
		<td><?php echo $row['room_name']; ?></td>
		<td><?php echo $row['room_bldg']; ?></td>
		<td><?php echo $row['room_floor']; ?></td>
		<td><?php echo $row['mac_address']; ?></td>
               
	</tr>

	<?php //open of second php
	}//close of while

  
	mysqli_close($con);

  

	?><!-- close of second php -->
  
</table>
 <font size="4" face="arial"  color="blue">
  <?php
 include 'connect.php';
  
  $result = mysqli_query($con,"SELECT * FROM tbl_roomlist ");
$rows = mysqli_num_rows($result);
 echo "<br>";
  echo "There are " . $rows . " record(s) in the table. ";
  	mysqli_close($con);
    ?>
    </font>
    <br><a href="homepage.php">Return to Homepage</a></br>
<center>
</body>
</html>