<?php
namespace template\App\Mail;

use Mailgun\Mailgun;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    // Send Account Mails eg Reset and Activate Accounts
    public static function send($from, $to, $subject, $html, $title)
    {
        
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'infotemplate2021@gmail.com';                     //SMTP username
            $mail->Password   = 'Portfolio12345';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom($from, $title);
            $mail->addAddress($to, '');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $html;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            //return $mail->ErrorInfo;
            return false;
        }
        
        // // First, instantiate the SDK with your API credentials
        // $mg = Mailgun::create(MAILGUN_API_KEY); // For US servers
        // // $mg = Mailgun::create('key-example', 'https://api.eu.mailgun.net'); // For EU servers

        // /**
        //  * Create the Email Composition
        //  */
        // $params = array(
        //     'from'    => $from,
        //     'to'      => $to,
        //     'subject' => $subject,
        //     'html'    => $html
        // );

        // /**
        //  * Sending Mail
        //  * $mg->messages()->send($domain, $params);
        //  */
        // $mg->messages()->send(MAILGUN_DOMAIN, $params);
    }
}
