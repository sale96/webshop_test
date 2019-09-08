<?php
session_start();

spl_autoload_register(function($name){
    require_once 'lib/'.$name.'.php';
});

$core = new Core();