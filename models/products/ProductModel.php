<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 2:19 PM
 */

class ProductModel
{
    private $connection;

    public function __construct()
    {
        try{
            global $database;
            $this->connection = $database->getConnection();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getAll(){
        $query = "SELECT * FROM products p JOIN product_image pi ON p.product_id = pi.product_id JOIN images i ON pi.image_id = i.image_id";
        return $this->connection->query($query)->fetchAll();
    }

    public function getSingle($id){
        $query = "SELECT * FROM products p JOIN product_image pi ON p.product_id = pi.product_id JOIN images i ON pi.image_id = i.image_id WHERE p.product = :id";
        $prepare = $this->connection->prepare($query);

        $prepare->bindParam(':id', $id);

        if($prepare->execute()){
            if($prepare->rowCount() == 1){
                return $prepare->fetch();
            }else{
                echo "No products found.";
            }
        }
    }

    public function add($request){
        $query = 'INSERT INTO products (product_name, product_price, product_price, product_quantity) VALUES(?,?,?,?)';
        $prepare = $this->connection->prepare($query);

        return $prepare->execute($request);
    }
}