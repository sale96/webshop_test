<?php
/**
 * Created by PhpStorm.
 * User: Sale
 * Date: 9/10/2019
 * Time: 9:28 PM
 */

class Cart_show extends Controller
{
    public function index(){
        if(isset($_POST['send-data-cart'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            if(!Sessions::isCart()){
                Sessions::setError('You don\'t have any items in the cart.');
                $data = $_POST;
                $this->view('cart/index', $data);
            }else{
                if(empty($name) || empty($email) || empty($address)){
                    Sessions::setError('You must enter your credentials for order to continue.');
                    $data = $_POST;
                    $this->view('cart/index', $data);
                }else{
                    $items = Sessions::getCart();
                    $total = 0;
                    $isFinished = false;
                    $query = 'INSERT INTO orders(first_last_name, address, email, total_price) VALUES (?,?,?,?)';

                    foreach($items as $item){
                        $total = $total + $item['price'] * $item['quantity'];
                    }

                    global $database;
                    $connection = $database->getConnection();
                    $prepare = $connection->prepare($query);
                    if($prepare->execute([$name, $address, $email, $total])){
                        $order_id = $connection->lastInsertId();
                        $query = 'INSERT INTO product_orders(order_id, product_id, quantity) VALUES (?,?,?)';
                        $prepare = $connection->prepare($query);
                        foreach($items as $item){
                            if($prepare->execute([$order_id, $item['id'], $item['quantity']])){
                                $isFinished = true;
                            }
                        }

                        if($isFinished){
                            Sessions::destroyCart();
                            Sessions::setSuccess('Your order has bees set.');
                            $this->view('cart/index');
                        }else{
                            Sessions::setError('Something went wrong, try later.');
                            $data = $_POST;
                            $this->view('cart/index', $data);
                        }
                    }else{
                        Sessions::setError('Something went wrong, try later.');
                        $data = $_POST;
                        $this->view('cart/index', $data);
                    }
                }
            }
        }else{
            $this->view('cart/index');
        }
    }
}