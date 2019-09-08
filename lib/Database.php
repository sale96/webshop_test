<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 12:50 PM
 */

class Database
{
    private $connection;

    public function __construct()
    {
        try{
            $dsn = 'mysql:host=' .HOST. ';dbname='.DBNAME;
            $this->connection = new PDO($dsn, USER, PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}