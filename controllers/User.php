<?php


class User extends Controller
{
    public function login(){
        $this->view('log/login');
    }

    public function register(){
        $this->view('log/register');
    }

    public function logout(){

    }
}