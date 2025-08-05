<?php
require_once "config/db.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

class Mailer{

    public function mailerFunction($email,$body,$subject){
        global $mail;
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = MAILER_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL;                     //SMTP username
            $mail->Password   = EMAIL_PASSWORD;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL);
            $mail->addAddress($email); 
            // $mail->addAddress('ellen@example.com'); //Name is optional
            $mail->addReplyTo(EMAIL);
            $mail->addCC(EMAIL);
            $mail->addBCC(EMAIL);

            //Attachments
            if(!empty($attach)){
                $mail->addAttachment($attach);         //Add attachments
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = '';

            $mail->send();
            // if ($send) {
            //     return 'Message has been sent';
            // }
            return 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function sendEscortRequestMessage($email,$username){
        global $mail, $db;
        $subject = 'Request - Incoming Escort Request';
        $body = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Escort Request</title>
            </head>
            <body>
                <div class="email_wrap">
                    <h5>Hi '.$username.',</h5>

                    <p>You have a new escort request, kindly check your task dashboard to approve the request
                    or click on this <a href="http://localhost/escort/my-tasks" style="text-decoration:none">link</a> to go to my task.</p>
                </div> 
               <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            </body>
            </html>';
        // foreach ($result as $to) {
            $this->mailerFunction($email,$body,$subject);

    }

    public static function sendWithdrawCode($email,$username, $amount, $code, $token,$ref){
        global $mail, $db;
        $body = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Withdrawal Code</title>
            </head>
            <body>
                <div class="email_wrap">
                    <h5>Hi '.$username.',</h5>

                    <p>A withdrawal transaction of <b>'. $amount .'</b> has been taken place on your account with us, if you are aware of the transaction or you took the action yourself, kindly click on the below link.</p>
                   <p>Click on this <a href="https://sanmtosapp.com/user/withdrawal-verification?wv='.$code.'&id='.$token.' " style="text-decoration:none">link</a> to complete your withdrawal request.</p>
                   <p>Kindly note your reference code: <b>'.$ref.'</b>, if you have any issue with your withdrawal transaction kindly contact our support team with your reference code via email <strong>supportteam@sanmtosapp.com</strong></p>
                </div> 
               <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
            </body>
            </html>';
        // foreach ($result as $to) {
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'premium155.web-hosting.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = EMAIL;                     //SMTP username
                $mail->Password   = EMAIL_PASSWORD;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom(EMAIL);
                $mail->addAddress($email); 
                // $mail->addAddress('ellen@example.com'); //Name is optional
                $mail->addReplyTo(EMAIL);
                $mail->addCC(EMAIL);
                $mail->addBCC(EMAIL);

                //Attachments
                if(!empty($attach)){
                    $mail->addAttachment($attach);         //Add attachments
                }

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Withdrawal Alert - Verify Your Investment Withdrawal';
                $mail->Body    = $body;
                $mail->AltBody = '';

                $mail->send();
                // if ($send) {
                //     return 'Message has been sent';
                // }
                return 'Message has been sent';
            } catch (Exception $e) {
                return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

    }

}

$mailer = new Mailer();