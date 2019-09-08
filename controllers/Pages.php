<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 1:00 PM
 */

class Pages extends Controller
{

    public function index(){
        //Loading view from Controller class
        $this->view('pages/index');
    }
}