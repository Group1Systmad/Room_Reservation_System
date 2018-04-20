<?php

mysql_connect("localhost", "root", "") or die("Connection Failed");
mysql_select_db("db_sched")or die("Connection Failed");
$message= $_POST['message'];
$query = "UPDATE announcements SET announcements= '$message' WHERE id= '1'";
if(mysql_query($query)){
echo '<script language="javascript">';
        echo 'alert("Announcement posted!!!")';
        echo '</script>';
        echo "<script>window.close();</script>";
        
}
else {echo '<script language="javascript">';
        echo 'alert("Update Failed!")';
        echo '</script>';
}
?>
<script type="text/javascript">
   function refreshParent();
</script>