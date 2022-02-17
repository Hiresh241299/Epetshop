<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
//$mail = new PHPMailer;
    try {
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'epetshopbse@gmail.com';                     // SMTP username
    $mail->Password   = 'stE&U?eK?Xi-Ajo+9!SW_dlJETReSuk4na#Hlsek!SpAS!uno?RE-*ph2PHL=A6p';      // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;       
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );// TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
        $mail->setFrom('epetshopbse@gmail.com', 'E-petshop');
        $mail->addAddress($email, $fname . " " . $lname);
        $mail->isHTML(true);// Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        $mail->send();
        //echo 'Mail Sent.';
        $mailstatus = 1; //mail sent
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $mailstatus = 0; //mail not sent
    }
?>