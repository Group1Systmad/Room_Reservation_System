<?php

?>

<html>
<head>
     <script type="text/javascript">
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
    

    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
     <link rel="stylesheet" href="mika/jumbotron.css" type="text/css">
</head>

<body>
<?php
    $_SESSION['changed'] = 0;
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none"; 
?>
 
 </div>
<div class="container" style="padding-top: 50px; background-color: #eceff8; width: 100%; height: 100%">
    <form method="post" name="update" action="update_announcement.php" style="color: #ff7a24; font-size: 20px" />
        Announcement: <div contenteditable="true"> 
            <textarea name="message" rows="10" cols="30" style="width: 350px; color: #304582; font-size: 15px"/>
            <?php
            include 'connect.php';
            $sql ="select announcements from announcements where ID='1'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            echo $row['announcements'];
            ?>  </textarea>
            <input type="submit" name="Submit" value="post" style="font-size: 14px"/>
</form>
         </div> 
   
    
</body>

</html>