<?php
    require_once 'databaseConnection.php'; 
    require_once 'config.php'; 
    require 'vendor/autoload.php';
    function SendMail($fname,$lname,$email,$vkey){
      // If you're using Composer (recommended)
        $to=$email
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("fmc202158@zealeducation.com", "Prasad Sanap");
        $email->setSubject("XKCD Comics");
        $email->addTo("$to","User Details");
        $email->addContent("text/plain","This is message from XKCD Comics.");
        $email->addContent(
            "text/html", "<h3>Hey <h1> $fname $lname</h1>, you're almost ready to start enjoing<h2> XKCD Comics.</h2>Simply verify your email address.</h3><br><h3>Verification Key:<br>$vkey</h3><br><br><br><h5>Thank you.</h5>"
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            header('location:thankyou.php?');
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
       
    }
   
?>
