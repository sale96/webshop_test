<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 6:03 PM
 */

class ProductImagesModel
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

    /*
     *
     *
     * STORING RELATION BETWEEN IMAGE AND PRODUCT INSIDE DATABASE
     *
     */

    public function add($product_id, $image_id = 1){
        $query = 'INSERT INTO product_image(product_id, image_id) VALUES(?,?)';
        $prepare = $this->connection->prepare($query);
        return $prepare->execute([$product_id, $image_id]);
    }
}