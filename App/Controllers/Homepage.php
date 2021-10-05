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

}