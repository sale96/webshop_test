<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/9/2019
 * Time: 1:40 PM
 */

class Cart extends Controller
{
    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            header('Location: index.php');
            exit();
        }
    }

    public function add($id){
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

        echo json_encode(Sessions::getCart());
        http_response_code(202);
    }

    public function remove($id){
        Sessions::destroyKeyCart($id);
        echo json_encode(Sessions::getCart());
        http_response_code(202);
    }

    public function destroy(){
        Sessions::destroyCart();
        echo json_encode(['message' => 'Success']);
        http_response_code(202);
    }

}