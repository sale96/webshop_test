<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/9/2019
 * Time: 1:40 PM
 */

class Cart extends Controller
{
    private $products;
    private $connection;
    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            header('Location: index.php');
            exit();
        }

        global $database;
        $this->connection = $database->getConnection();
        $this->products = $this->model('products/ProductModel');
    }

    public function add($id){
        $product = $this->products->getSingle($id);
        $response = 404;
        $data['quantity'] = (int)$product->product_quantity;
        if($product->product_quantity > 0){
            $id_array = [];
            if(Sessions::isCart()){
                $counter = count(Sessions::getCart());
                $id_array = array_column(Sessions::getCart(), 'id');
                if(!in_array($id, $id_array)){
                    Sessions::setCart([
                        'id' => $_POST['id'],
                        'name' => $_POST['name'],
                        'price' => (double)$_POST['price'],
                        'quantity' => (int)$_POST['quantity']
                    ], $counter);
                }else{
                    for($i = 0; $i < count($id_array); $i++){
                        if($id_array[$i] == $id){
                            Sessions::incrementCart(1, $i);
                        }
                    }
                }
            }else{
                Sessions::setCart([
                    'id' => $_POST['id'],
                    'name' => $_POST['name'],
                    'price' => (double)$_POST['price'],
                    'quantity' => (int)$_POST['quantity']
                ], 0);
            }
            $query = "UPDATE products SET product_quantity = product_quantity - 1 WHERE product_id = ?";
            $prepare = $this->connection->prepare($query);

            if($prepare->execute([$id])){
                $response = 202;
                $data['quantity']--;
                $data['product'] = Sessions::getCart();
            }
        }else{
            $response = 404;
        }


        echo json_encode($data);
        http_response_code($response);
    }

    public function remove($id){

        $quantity = (int)$_POST['quantity'];

        $query = "UPDATE products SET product_quantity = product_quantity + ? WHERE product_id = ?";
        $prepare = $this->connection->prepare($query);
        $responseCode = 404;

        if($prepare->execute([$quantity, $id])){
            $responseCode = 202;
            Sessions::destroyKeyCart($id);
        }else{
            $responseCode = 500;
        }

        if(Sessions::isCart()){
            echo json_encode(Sessions::getCart());
        }
        http_response_code($responseCode);
    }

    public function destroy(){
        Sessions::destroyCart();
        echo json_encode(['message' => 'Success']);
        http_response_code(202);
    }

}