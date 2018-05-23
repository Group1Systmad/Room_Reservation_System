<?php
session_start();
?>
<html>
<head>
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<meta charset=utf-8 />
    <script type="text/javascript">
          window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        .max-height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        </script>
        <style>
            
            .controls{
                text-align: center;
            }
            
        </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Icon</title>
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
 <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            ?>
 <div class="center"> 
             <?php
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            function changeimage($empno,  $file_temp, $file_extn){
            include 'connect.php';
            $sql ="select * from accounts where Acc_Uname='".$_SESSION['username']."'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $sql1 ="select * from employee where Employee_ID='".$row['Employee_ID']."'";
            $res1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_array($res1);
            $file_path = 'C:/xampp/htdocs/Room_Reservation_System/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
            $file_photo = substr(md5(time()), 0, 10) . '.' . $file_extn;
            if (move_uploaded_file($file_temp, $file_path)) {
                echo '<script language="javascript">';
                 echo 'alert("Successful!")';
                echo '</script>';
                echo "<script> refreshParent();</script>";
                 echo "<script>window.close(); </script>";
                 $SQL= "UPDATE employee SET Emp_Photo='$file_photo' WHERE Employee_ID='".$row['Employee_ID']."'";
                    mysqli_query($con,$SQL)or die('Error:'.mysqli_error($con));
                    mysqli_close($con);
                }
            else {
               echo "<P>Upload failed! Please select a file lower than 2MB</P>";}
                 
       }
     
       
      if (isset($_FILES['profile']) === TRUE){
          if (empty($_FILES['profile']['name']) === TRUE){
              echo 'Please choose a file';
          }
          else {
              $allowed = array('jpg','jpeg','gif', 'png');
                      $file_name = $_FILES['profile']['name'];
                      $explode = explode('.', $file_name);
                      $end = end($explode);
                      
                      $file_extn = strtolower($end);
                      $file_temp = $_FILES['profile']['tmp_name'];
                      
                      if (in_array($file_extn, $allowed) === true){
                           changeimage($row['Employee_ID'],  $file_temp, $file_extn);
                      }
                     else {                          
                         echo 'Incorrect file type! Allowed: ';
                         echo implode(', ', $allowed);                        
                     }            
          }
      }

       ?>

 </div>
<div class="container" style="padding-top: 50px; background-color: #3A539B; width: 100%; height: 100%;">
     <div class="center"> <img id="blah" src= "<?php  if (empty($row1['Emp_Photo'])){ echo "Male User_96px.png";} else {echo $row1['Emp_Photo'];}?>" alt="User Portrait" style=" display: block; border-radius: 100%;width: 200px; max-height: 200px;border: 5px solid #fff;margin-left:60px">  </div>
     <div class="controls"><p style="font-size:12px; color:white; margin-left: 70px; "> Change your avatar</p>
         <form action=""  method="post" enctype="multipart/form-data" style="color: #ebebe0;margin: auto; margin-left:200px" runat="server">
        <input type="file" name="profile" onchange="readURL(this);"> 
        <input onclick="window.location.href = 'user_account.php';" type="submit" name="submit" style="color:black; margin-left: 70px">
      </form> 
     </div>
         </div> 
     
    
</body>

</html>