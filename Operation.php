<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//name 
$name = $_GET['Name'];
echo 'Your name is ' . $name ; 

//gender
$gender = $_GET['gender'];
echo ', a ' . $gender . ',' . '&nbsp';

//address
$address = $_GET['add'];
echo 'living in '.$address. '&nbsp';

//province
$province = $_GET['prov'];
echo 'the province is '. $province . '&nbsp' ;


//hobbies
echo 'with a hobby of ';

$from = "PHP@Netbeans.com";
$email = $_GET['emailadd'];
$subject = "For assignment 1";
$message = 'Your name is ' . $name . ', a ' . $gender . ',' . ' ' . 'living in '.$address. ' '. 'the province is '. $province . ' with a hobbies of';

$hob = $_GET['hobby'];
foreach ($hob as $hobby){ 
   $hobs = ", ".$hobby  ; 
   $message = $message .  $hobs;
}

$message = $message .".";



ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");

mail($email, $subject, $message , "From: " . $from);


        
       echo 'Ole'
        


?>