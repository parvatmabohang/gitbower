<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '/opt/lampp/htdocs/bower/PHPMailer/src/Exception.php';
require '/opt/lampp/htdocs/bower/PHPMailer/src/PHPMailer.php';
require '/opt/lampp/htdocs/bower/PHPMailer/src/SMTP.php';


class Smail{

function call($uidemail,$pemail,$pid)
{
  $mail = new PHPMailer(true);                 // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $uidemail;                 // SMTP username
    $mail->Password = 'parvat123';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($uidemail, 'Colors2web');
    $mail->addAddress($pemail, 'user');     // Add a recipient             // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
      //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Product's ID";
    $mail->Body    = "The product ID I want to buy is <b>$pid</b>";
    $mail->AltBody = 'This is a plain-text message body';

    $mail->send();

    return true;
}
catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    return false;
}}

}
