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
        $query = "SELECT * FROM products p LEFT JOIN product_image pi ON p.product_id = pi.product_id LEFT JOIN images i ON pi.image_id = i.image_id";
        return $this->connection->query($query)->fetchAll();
    }

    public function getSingle($id){
        $query = "SELECT * FROM products p LEFT JOIN product_image pi ON p.product_id = pi.product_id LEFT JOIN images i ON pi.image_id = i.image_id WHERE p.product_id = :id";
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
        $query = 'INSERT INTO products (product_name, product_desc, product_price, product_quantity) VALUES(?,?,?,?)';
        $prepare = $this->connection->prepare($query);

        return $prepare->execute($request);
    }

    public function update($response, $id){
        $query = "UPDATE products SET product_name = :name, product_price = :price, product_desc = :desc, product_quantity = :quan WHERE product_id = :id";
        $prepare = $this->connection->prepare($query);

        $prepare->bindParam(':name', $response['product-name']);
        $prepare->bindParam(':price', $response['product-price']);
        $prepare->bindParam(':desc', $response['product-desc']);
        $prepare->bindParam(':quan', $response['product-quantity']);
        $prepare->bindParam(':id', $id);

        return $prepare->execute();
    }

    public function delete($id){
        $query = "DELETE FROM products WHERE product_id = :id";
        $prep = $this->connection->prepare($query);
        $prep->bindParam(':id', $id);

        return $prep->execute();
    }
}