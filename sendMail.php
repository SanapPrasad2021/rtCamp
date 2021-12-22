<?php
    require_once 'databaseConnection.php'; 
    function SendMail($fname,$lname,$email,$vkey){
      // If you're using Composer (recommended)
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("fmc202158@zealeducation.com", "Prasad Sanap");
        $email->setSubject("XKCD Comics");
        $email->addTo("$email","User Details");
        $email->addContent("text/plain","This is message from XKCD Comics.");
        $email->addContent(
            "text/html", "<h3>Hey $fname $lname, you're almost ready to start enjoing<strong> XKCD Comics.</strong>Simply verify your email address.</h3><br><h3>Verification Key:<br>$vkey</h3><br><br><br><h5>Thank you.</h5>"
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
        header('location:thankyou.php?');
    }
   
?>
