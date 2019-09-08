<?php
session_start();
require 'config/config.php';
spl_autoload_register(function($name){
    require_once 'lib/'.$name.'.php';
});

$database = new Database();
$core = new Core();