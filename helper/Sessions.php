<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 7:13 PM
 */

class Sessions
{
    //ERROR MESSAGES
    public static function setError($err){
        $_SESSION['error'] = $err;
    }

    public static function getError(){
        return $_SESSION['error'];
    }

    public static function destroyError(){
        unset($_SESSION['error']);
    }

    //Success messages
    public static function setSuccess($message){
        $_SESSION['success'] = $message;
    }

    public static function getSuccess(){
        return $_SESSION['success'];
    }

    public static function destroySuccess(){
        unset($_SESSION['success']);
    }
}