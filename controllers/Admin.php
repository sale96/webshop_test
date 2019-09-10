<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/8/2019
 * Time: 2:17 PM
 */

class Admin extends Controller
{

    public function __construct()
    {
        if(Sessions::isLogged()){
            if($this->user->getUserData()->role_id != 1){
                header('Location: index.php');
                exit();
            }
        }else{
            header('Location: index.php');
            exit();
        }
    }
    /*
     *
     *
     * INDEX METHOD FOR INSERTING PRODUCTS/IMAGES AND RELATION BETWEEN BOTH, CHECKING FOR EMPTY FIELDS
     * USES MODELS FOR DATABASE STUFF
     *
     */
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

    /*
     *
     *
     * PRODUCTS METHOD GIVE US TABLE OF ALL PRODUCTS WITH AN OPTION TO GO REMOVE AND UPDATE BOTH
     *
     */
    public function products(){
        $products = $this->model('products/ProductModel');
        $data['products'] = $products->getAll();
        $this->view('admin/products', $data);
    }

    /*
     *
     *
     * REMOVING PRODUCTS FROM DATABASE, ID COMES FROM PRODUCTS METHOD INSIDE VIEW
     *
     */
    public function remove($id){
        $product = $this->model('products/ProductModel');
        if($product->delete($id)){
            Sessions::setSuccess('Product deleted');
            header('Location: index.php?page=Admin/products');
            exit();
        }else{
            Sessions::setError('Error deleting product');
            header('Location: index.php?page=Admin/products');
            exit();
        }

    }


    /*
     *
     *
     * UPDATE METHOD FOR CONTROLLING VIEW AND GETTING MODEL FOR UPDATE
     *
     */
    public function update($id){
        $product = $this->model('products/ProductModel');
        $data['product'] = $product->getSingle($id);
        $data['id'] = $id;
        if(isset($_POST['product-submit'])){
            $name = $_POST['product-name'];
            $quantity = $_POST['product-quantity'];
            $price = $_POST['product-price'];
            $desc = $_POST['product-desc'];

            if(empty($name) || empty($quantity) || empty($price) || empty($desc)){
                Sessions::setError('Fields must not be empty.');
                $this->view('admin/update', $data);
            }else{
                if($product->update($_POST, $id)){
                    Sessions::setSuccess('Successfuly updated product.');
                    $this->view('admin/update', $data);
                }
            }
        }else{
            $this->view('admin/update', $data);
        }
    }

    public function orders(){
        $query = "SELECT *, po.quantity as item_quantity FROM orders o INNER JOIN product_orders po ON o.order_id = po.order_id INNER JOIN products p ON po.product_id = p.product_id";
        global $database;
        $connection = $database->getConnection();
        $data['order'] = $connection->query($query)->fetchAll();
        $this->view('admin/orders', $data);
    }
}