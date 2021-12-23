<?php
require_once 'databaseConnection.php';
require_once 'config.php'; 
require 'vendor/autoload.php';

class AutoSendingMail{
    function SendMail($receiver,$urlImg,$imgTitle){
        $to=implode("",$receiver);
        // $subject="XKCD Comics";
        // $message="This is lovely XKCD comics picture.<br><img src=".$urlImg."><br><br><br><br><p>
        // Unsubscribe or change your email preferences click on below link.</p><br><p>https://sample-ps-website.herokuapp.com/unsubscribe.php</p>";
        // $sender ="From: fmc202158@zealeducation.com\r\n";
        // $sender .= "MIME-Version: 1.0"."\r\n";
        // $sender .="Content-type:text/html;charset=UTF-8"."\r\n";
        // mail($to,$subject,$message,$sender);

        // If you're using Composer (recommended)
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("fmc202158@zealeducation.com", "Prasad Sanap");
        $email->setSubject("XKCD Comics");
        $email->addTo("$to","User Details");
        $email->addContent("text/plain","This is message from XKCD Comics.");
        $email->addContent(
            "text/html", "<strong>This is lovely XKCD comics picture.<br>Title:".$imgTitle."<br></strong><img src=".$urlImg."><br><br><br><br>
            Unsubscribe or change your email preferences click on below link.</p><br><a href=https://sample-ps-website.herokuapp.com/unsubscribe.php>unsubscribe</a>"
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
    }
}


// Remote Database Connection
$asm=new AutoSendingMail();
$email=$mysqli->query("SELECT email FROM visitor_det WHERE action='start'");

// set array
$array = array();
// look through query
while($row = mysqli_fetch_assoc($email)){
  // add each row returned into an array
  $array[] = $row;
}

// Fatching the random image.
$no=rand(1,614);
$value=curl_init("https://xkcd.com/".$no."/info.0.json");
curl_setopt($value,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($value,CURLOPT_RETURNTRANSFER,true);
$result=curl_exec($value);
curl_close($value);
$data=json_decode($result);
// echo $data->img;
$imgUrl=$data->img;
$imgTitle=$data->title;
echo $imgTitle;
echo $imgUrl;


// Foreach array loop and send email to them.
foreach($array as $val){
    print_r($val);
    $asm->SendMail($val,$imgUrl,$imgTitle);
}

?>