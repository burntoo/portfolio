<?php
namespace Portfolio\App\Libraries;

/**
 * Base Controller
 * Loads the models and views
 */

class Controller{
    // Load Models
    public function model($model){
        //require model file
        require('Portfolio\\App\\Models\\' . $model . '.php');

        //Instantiate
        return new $model;
    }

    // Load View
    public function view($view, $data=[]){
        // Check for view file
        if(file_exists('../App/Views/' . $view . '.php')){
            require('../App/Views/' . $view . '.php');
        } else{
            die("View Does not exist");
        }
    }
}