<?php
session_start();
?>
<html>
<head>
    <title>About Us</title>
    <style>

abnav {
    height: 100%;
    right:0;
    font-family: Arial;
}

.tablink {
    background-color: #000033;
    color: white;
    float: right;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 10px 12px;
    height: 50.5px;
    font-size: 14px;
    width: 24%;
}

.tablink:hover {
    background-color: #777;
}

.tablink:focus{
    color: #000033;
}


.tabcontent {
    color: #000000;
    display: none;
    padding: 100px 20px;
    margin-left: 6%;
    height: 100%;
}

#Support {background-color: #ffffff;}
#Help {background-color: #ffffff;}
#OurTeam {background-color: #ffffff;}
#Vision {background-color: #ffffff;}
</style>

    <script type="text/javascript">
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
             document.getElementById("myAccountnav").style.border = "1px solid black";
}
        function closeaccNav() {
            document.getElementById("myAccountnav").style.width = "0";
            document.getElementById("myAccountnav").style.border = "none";
}
</script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--    <link rel="stylesheet" href="bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bren/side_bar.css" type="text/css">
    <link rel="stylesheet" href="mika/about.css" type="text/css">
    <link rel="stylesheet" href="mika/aboutus.css" type="text/css">
    
    
</head>

<body onload="startTime()">
<?php
    $_SESSION["count"]=1;
    $_SESSION["selected"]="none";

?>
    

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
           <div class="logoutbtn"> <a class="btn btn-danger" onclick="return logout()" <?php 
                $_SESSION["login"] = 'logout'; ?> href="login_page.php">Logout</a></div>
            </div>
</div>
    
<div class="sidebar">
    <ul>
        <li> <img src ='logo3.png' style="width: 78%; border-radius: 100%; margin-left: 7px; margin-top: 7px; margin-bottom: 5px"></li>
        <li><a onclick="return openaccNav()"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Admin</span></a></li>
        <li><a href="homepage.php"><span class="glyphicon glyphicon-cloud"></span><span class="menu_label">Home</span></a></li>
        <li><div class="selected"><a href="aboutusadmin.php" ><span class="glyphicon glyphicon-info-sign" ></span><span class="menu_label">About</span></a></div></li>
        <li><a href="employees.php"><span class="glyphicon glyphicon-user"></span><span class="menu_label">Accounts</span></a></li>
        <li><a href="schedtable.php"><span class="glyphicon glyphicon-calendar"></span><span class="menu_label">Reservations</span></a></li>
        <li><a href="Room_View.php"><span class="glyphicon glyphicon-blackboard"></span><span class="menu_label">Rooms</span></a></li>
        <li><div id="time" style="padding-top:180px; font-size: 18px; color:white;text-align: center"></div> </li>
        <li><div id="date" style=" font-size: 12px; color:#ff7a24; text-align: center"></div> </li></ul>
        
    </ul>
</div>
<div class="container">

         </div>
    <div class="abnav">
<button class="tablink" onclick="openPage('Support', this, '#ffffff')">Support</button>
<button class="tablink" onclick="openPage('Help', this, '#ffffff')">Help</button>
<button class="tablink" onclick="openPage('OurTeam', this, '#ffffff')">Our Team</button>
<button class="tablink" onclick="openPage('Vision', this, '#ffffff')" autofocus="on" id="defaultOpen">Vision</button>


<div id="Support" class="tabcontent">
    <h3> Support </h3>
  <p>Recommendation & shit</p>
</div>

<div id="Help" class="tabcontent">
  <h3>Help</h3>
  <p>Here goes the user manual!</p> 
</div>

<div id="OurTeam" class="tabcontent">
    <h3 style="font-size: 18px; text-align: center; color: #777; padding-top: 2%">Who we are? Meet our team!</h3>
    <p style="font-size: 14px; text-align: center; color: #777"> We listen, we discuss, we develop. We love to learn and use the latest technologies. </p>
    <div class="cardjay" style="background: white; width: 15%;  margin: auto;  text-align: center; font-family: arial; position: fixed; top: 45%; right: 3%; border-radius: 5px;">
        <img src="alain.jpg" alt="Alain" style="width:70%;  border-radius: 5px; align-self: center; padding-top: 10px; border-radius: 100%" >
        <div class="ourname" style="padding-top: 10px; font-family: Lucida Console, fantasy; color: #000000; font-size: 20px;"> Alain Paciteng</div>
        <p class="title" style="color:  #ff7a24;font-size: 11px;">Back End Programmer</p>
                <div style="margin: 10px; text-decoration: none;font-size: 10px;color: black;">
                     <a href="http://twitter.com/APaciteng" target="_blank"><i class="fa fa-twitter"></i></a>  
                     <a href="http://facebook.com/alain.paciteng"><i class="fa fa-facebook"></i></a> 
                        </div>
        <p><button style="border: none;outline: 0; display: inline-block; padding: 8px; color: white; background-color: #ff7a24; text-align: center; cursor: pointer; width: 100%; font-size: 8px;">Email</button></p>
                </div>
              
<div class="cardjay" style="background: white; width: 15%;  margin: auto;  text-align: center; font-family: arial; position: fixed; top: 45%; right: 21%; border-radius: 5px;">
        <img src="mika.jpg" alt="Mika" style="width:70%;  border-radius: 5px; align-self: center; padding-top: 10px; border-radius: 100%" >
        <div class="ourname" style="padding-top: 10px; font-family: Lucida Console, fantasy; color: #000000; font-size: 24px;"> Mika Aguilar</div>
        <p class="title" style="color:  #ff7a24;font-size: 11px;">Front End Designer</p>
                <div style="margin: 10px; text-decoration: none;font-size: 10px;color: black;">
                     <a href="http://twitter.com/mikaaguilar_" target="_blank"><i class="fa fa-twitter"></i></a>  
                     <a href="http://facebook.com/ohmikachu"><i class="fa fa-facebook"></i></a> 
                        </div>
        <p><button style="border: none;outline: 0; display: inline-block; padding: 8px; color: white; background-color: #ff7a24; text-align: center; cursor: pointer; width: 100%; font-size: 8px;">Email</button></p>
                </div>
    
    <div class="cardbren" style="background: white; width: 15%;  margin: auto;  text-align: center; font-family: arial; position: fixed; top: 45%; right: 39%; border-radius: 5px;">
        <img src="bren.jpg" alt="Bren" style="width:70%;  border-radius: 5px; align-self: center; padding-top: 10px; border-radius: 100%" >
        <div class="ourname" style="padding-top: 10px; font-family: Lucida Console, fantasy; color: #000000; font-size: 24px;"> Bren Loria</div>
        <p class="title" style="color:  #ff7a24;font-size: 11px;">Database & Hardware Developer</p>
                <div style="margin: 10px; text-decoration: none;font-size: 10px;color: black;">
                     <<a href="http://twitter.com/loriaffe" target="_blank"><i class="fa fa-twitter"></i></a>  
                     <a href="http://facebook.com/loriaffe"><i class="fa fa-facebook"></i></a> 
                        </div>
        <p><button style="border: none;outline: 0; display: inline-block; padding: 8px; color: white; background-color: #ff7a24; text-align: center; cursor: pointer; width: 100%; font-size: 8px;">Email</button></p>
                </div>
    
    <div class="cardmar" style="background: white; width: 15%;  margin: auto;  text-align: center; font-family: arial; position: fixed; top: 45%; right: 57%; border-radius: 5px;">
        <img src="marserrano.jpg" alt="Mar" style="width:70%;  border-radius: 5px; align-self: center; padding-top: 10px; border-radius: 100%" >
        <div class="ourname" style="padding-top: 10px; font-family: Lucida Console, fantasy; color: #000000; font-size: 24px;"> Mar Serrano</div>
        <p class="title" style="color:  #ff7a24;font-size: 11px;">Software Developer</p>
                <div style="margin: 10px; text-decoration: none;font-size: 10px;color: black;">
                     <a href="http://twitter.com/MCFSOfficial" target="_blank"><i class="fa fa-twitter"></i></a>  
                     <a href="http://facebook.com/marchristian.serrano"><i class="fa fa-facebook"></i></a> 
                        </div>
        <p><buttona style="border: none;outline: 0; display: inline-block; padding: 8px; color: white; background-color: #ff7a24; text-align: center; cursor: pointer; width: 100%; font-size: 8px;">Email</buttona></p>
                </div>
    
    <div class="cardjay" style="background: white; width: 15%;  margin: auto;  text-align: center; font-family: arial; position: fixed; top: 45%; right: 75%; border-radius: 5px;">
        <img src="marjaygab.jpg" alt="Marjay" style="width:70%;  border-radius: 5px; align-self: center; padding-top: 10px; border-radius: 100%">
        <div class="ourname" style="padding-top: 10px; font-family: Lucida Console, fantasy; color: #000000; font-size: 24px;"> Marjay Tapay</div>
        <p class="title" style="color:  #ff7a24;font-size: 11px;">Scrum Master & Project Manager</p>
               <div style="margin: 10px; text-decoration: none;font-size: 10px;color: black;">
                     <a href="http://twitter.com/MarjayGab" target="_blank"><i class="fa fa-twitter"></i></a>  
                     <a href="http://facebook.com/frozenpenofmind"><i class="fa fa-facebook"></i></a> 
                        </div>
        <p><button style="border: none;outline: 0; display: inline-block; padding: 8px; color: white; background-color: #ff7a24; text-align: center; cursor: pointer; width: 100%; font-size: 8px;"> Email</button></p>
                </div>
                </div>

<div id="Vision" class="tabcontent">
  <h3>Our Vision</h3>
  <p>Who we are and what we do.</p>
</div>

<script>
function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
    </div>

</body>

</html>