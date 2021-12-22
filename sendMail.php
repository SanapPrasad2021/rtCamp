<?php
    require_once 'databaseConnection.php'; 
    function SendMail($fname,$lname,$email,$vkey){
        // Sending email
        $to=$email;
        $subject="Email Verification";
        $message="<h3>Hey $fname $lname, you're almost ready to start enjoing<strong> XKCD Comics.</strong>Simply verify your email address.</h3><br><h3>Verification Key:<br>$vkey</h3><br><br><br><h5>Thank you.</h5>";
        $sender ="From: fmc202158@zealeducation.com\r\n";
        $sender .="MIME-Version: 1.0"."\r\n";
        $sender .="Content-type:text/html;charset=UTF-8"."\r\n";
        mail($to,$subject,$message,$sender);
        header('location:thankyou.php?');
    }
   
?>