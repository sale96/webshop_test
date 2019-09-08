<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 12:50 PM
 */

class Controller
{
    public function model($model){
        //Checking if model exists
        if(file_exists('models/' . $model . '.php')){
            require_once 'models/' . $model . '.php';
            //if model is inside folder we need to turn it into array
            if(preg_match('/[\/]/', $model)){
                $model = explode('/', $model);
                return new $model[1];
            }else{
                //If not we instantiate him
                return new $model;
            }
        }
    }

    public function view($view, $data = []){
        //Basic header layout
        require 'views/layouts/header.php';

        //Checking if model exists
        if(file_exists('views/' . $view . '.php')){
            require 'views/' . $view . '.php';
        }else{
            echo 'View does not exist.';
        }

        //Basic footer layout
        require 'views/layouts/footer.php';
    }
}