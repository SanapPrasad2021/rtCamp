<?php


    function SendMail($fname,$lname,$email,$vkey)
    {
        $to=$email;
        $subject="Email Verification";
        $message= "<h3>Hey $fname $lname, you're almost ready to start enjoing<strong> XKCD Comics</strong>.Simply verify your email address with below.</h3><br><h3>Verification OTP:<br>$vkey</h3><br><br><br><h5>Thank you.</h5>";
        $sender = "From: prasadsanap@epavitram.com\r\n";
        $sender .= "MIME-Version: 1.0"."\r\n";
        $sender .="Content-type:text/html;charset=UTF-8"."\r\n";
        mail($to,$subject,$message,$sender);
        header('location:thankyou.php');  
    }

?>