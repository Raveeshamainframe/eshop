<?php

require "connection.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {

    $e = $_GET["e"];

    if (empty($e)) {
        echo "Please enter your email address";
    } else {
        $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $e . "' ");

        if ($rs->num_rows == 1) {

            $code = uniqid();

            Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $e . "'");

            // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vidhuraneethika000@gmail.com'; 
            $mail->Password = 'Neethika@0719'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('vidhuraneethika000@gmail.com', 'eShop'); 
            $mail->addReplyTo('vidhuraneethika000@gmail.com', 'eShop'); 
            $mail->addAddress($e); 
            $mail->isHTML(true);
            $mail->Subject = 'eShop Admin verification code'; 
            $bodyContent = '<h1 style="color:red;"> Your verification code : '. $code . '</h1>'; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending fail.Mailer Error: '.$mail->ErrorInfo; 
            } else {
                echo 'Success';
            }
        } else {
            echo "Email address not found";
        }
    }
} else {
    echo "Please Enter your email adress";
}

?>