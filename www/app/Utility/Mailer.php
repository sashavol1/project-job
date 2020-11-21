<?php

namespace App\Utility;
use App\Utility;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/**
 * Mailer helps method for send email
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Mailer {

    /**
     * Check Authenticated: Checks to see if the user is authenticated,
     * destroying the session and redirecting to a specific location if the user
     * session doesn't exist.
     * @access public
     * @param string $redirect
     * @since 1.0.2
     */
    public function send($title = "", $text = "", $emailTo = "") {
        echo 'ok';
        die();
        // Instantiation and passing `true` enables exceptions
        // $mail = new PHPMailer(true);

        // try {
        //     //Server settings
        //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        //     $mail->isSMTP();                                            // Send using SMTP
        //     $mail->Host       = 'smtp1.example.com';                    // Set the SMTP server to send through
        //     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        //     $mail->Username   = 'user@example.com';                     // SMTP username
        //     $mail->Password   = 'secret';                               // SMTP password
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        //     $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //     //Recipients
        //     $mail->setFrom('from@example.com', 'Mailer');
        //     $mail->addAddress($emailTo, 'Joe User');     // Add a recipient
        //     // $mail->addReplyTo('info@example.com', 'Information');
        //     // $mail->addCC('cc@example.com');
        //     // $mail->addBCC('bcc@example.com');

        //     // Content
        //     $mail->isHTML(true);                                  // Set email format to HTML
        //     $mail->Subject = $title;
        //     $mail->Body    = $text;
        //     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        //     $mail->send();
        //     echo 'Message has been sent';
        // } catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }
    }

}
