<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 7:13 PM
 */

class Sessions
{
    /*
     *
     *
     * FOR EASIER WORKING WITH SESSIONS AND FOR ELIMINATING MISS SPELLINGS
     *
     */


    //ERROR MESSAGES
    public static function isError(){
        return isset($_SESSION['error']);
    }
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
    public static function isSuccess(){
        return isset($_SESSION['success']);
    }
    public static function setSuccess($message){
        $_SESSION['success'] = $message;
    }

    public static function getSuccess(){
        return $_SESSION['success'];
    }

    public static function destroySuccess(){
        unset($_SESSION['success']);
    }


    //Cart sessions
    public static function setCart($value, $key = 0){
        $_SESSION['cart'][$key] = $value;
    }

    public static function isCart(){
        return isset($_SESSION['cart']);
    }

    public static function getCart(){
        return $_SESSION['cart'];
    }

    public static function incrementCart($val, $i){
        $_SESSION['cart'][$i]['quantity'] += $val;
    }

    public static function destroyCart(){
        unset($_SESSION['cart']);
    }

    public static function destroyKeyCart($index){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['id'] == $index){
                unset($_SESSION['cart'][$key]);
            }
        }

        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    //USER SESSIONS
    public static function isLogged(){
        return isset($_SESSION['logged']);
    }

    public static function setLogged($id, $role_id = 0){
        $_SESSION['logged'] = [
            'id' => $id,
            'role_id' => $role_id
        ];
    }

    public static function getLogged($param){
        return $_SESSION['logged'][$param];
    }

    public static function destroyLogged(){
        unset($_SESSION['logged']);
    }
}