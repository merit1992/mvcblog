<?php

class Controller {
    // load the model
    public function model($model) {
        require_once '../app/models/'. $model . '.php';
        return new $model();
    }
    // load the model and check for the file
    public function view($view, $data = []){
        if (file_exists('../app/views/'. $view . '.php')) {
            require_once '../app/views/'. $view . '.php';
        } else {
            die('View does not exist');  
        }
        
    }
}