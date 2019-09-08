<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 2:17 PM
 */

class Admin extends Controller
{

    public function index(){
        if(isset($_POST['product-submit'])){
            $name = $_POST['product-name'];
            $quantity = $_POST['product-quantity'];
            $price = $_POST['product-price'];
            $desc = $_POST['product-desc'];

            $image = $_FILES['product-image'];

            if(empty($name) || empty($quantity) || empty($price) || empty($desc)){
                Sessions::setError('You must enter values in the fields.');
                $data['request'] = $_POST;
                $this->view('admin/index', $data['request']);
            }else{
                $imageModel = $this->model('ImageModel');
                $imageModel->setParams($image);

                $location = 'assets/images/product/';

                if(!$imageModel->checkForErrorsAndUpload($location, $name)){
                    Sessions::setError('Something went wrong.');
                    $data['request'] = $_POST;
                    $this->view('admin/index', $data['request']);
                }else{

                    global $database;
                    $connection = $database->getConnection();

                    $image_id = $connection->lastInsertId();

                    $productModel = $this->model('products/ProductModel');

                    if($productModel->add([$name, $desc, $price, $quantity])){
                        $product_id = $connection->lastInsertId();

                        $prod_image = $this->model('products/ProductImagesModel');
                        if($prod_image->add($product_id, $image_id)){
                            Sessions::setSuccess('Successful added product.');
                            $data['request'] = $_POST;
                            $this->view('admin/index', $data['request']);
                        }
                    }

                }
            }
        }else{
            $this->view('admin/index');
        }
    }

}