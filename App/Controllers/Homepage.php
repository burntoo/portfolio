<?php
namespace Portfolio\App\Controllers;

use Portfolio\App\Libraries\Controller;


class Homepage extends Controller{


    public function __construct(){
        
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
                $this->mail->send('example@gmail.com', 'info@example.com', 'Website Message', '<p style="font-size: 15px;"><b>New Message From:</b><p><br/><b>Full Name:</b> '.$data['name'].'<br/><b>Email:</b> '.$data['email'].', <br/><b>Message:</b> '.$data['message'], 'New Website Message');
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

    private function isArrayEmpty($array) {
        
        foreach($array as $val) {
            if (empty($val)){
                return true;
            }
        }
        return false;
    }


}