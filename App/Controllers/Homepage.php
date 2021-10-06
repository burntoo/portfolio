<?php
namespace Portfolio\App\Controllers;

use Portfolio\App\Libraries\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Homepage extends Controller{

    private $mail;

    public function __construct(){
        //$this->mail = new \Portfolio\App\Mail\Mail;
    }

    public function index(){
        $data = [
            'title' => 'Portfolio',
            'page' => 'homepage'
          ];

        $this->view('homepage/index', $data);
    }

    public function sendMessage(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            // Init Data
            $data = array(
                'title' => 'Portfolio',
                // Validate Form
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'message' => trim($_POST['message']),
    
                'description' => ''
            );

            $errors = array();

            if (empty($data['name'])) {
                $errors["name_err"] = "error-name";
            }
            if (empty($data['email'])) {
                $errors["email_err"] = "error-email";
            }
            if (empty($data['message'])) {
                $errors["message_err"] = "error-message";
            }

            if(!empty($errors)){
                $errors['success'] = 0;    
                echo json_encode($errors);
            }
            else{
                //send mail
                ## TODO: CHECK WHY MAIL MODEL IS NOT BEING LOADED
                //$this->mail->send('triplepi39@gmail.com', 'ngangamartin11@gmail.com', 'Website Message', '<p style="font-size: 15px;"><b>New Message From:</b><p><br/><b>Full Name:</b> '.$data['name'].'<br/><b>Email:</b> '.$data['email'].', <br/><b>Message:</b> '.$data['message'], 'New Website Message');
                $this->send('sendingemail@gmail.com', 'destinationexample@gmail.com', 'Website Message', '<p style="font-size: 15px;"><b>New Message From:</b><p><br/><b>Full Name:</b> '.$data['name'].'<br/><b>Email:</b> '.$data['email'].', <br/><b>Message:</b> '.$data['message'], 'New Website Message');
                echo json_encode(["success" => 1, "message" => "message sent successfully"]);
            }
        }
        else{
            $data = array(
                'success' => 0,
                'title' => 'Portfolio',
                'post_err' => 'invalid request',
                'description' => ''
            );

            echo json_encode($data);
        }
    }

    private static function send($from, $to, $subject, $html, $title)
    {
        
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'sendingemail@gmail.com';                     //SMTP username
            $mail->Password   = 'pass123456789';                               //SMTP password
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
    }

}