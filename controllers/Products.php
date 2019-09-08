<?php


class Products extends Controller
{
    private $products;

    public function __construct()
    {
        $this->products = $this->model('products/ProductModel');
    }

    public function index(){
        $data['products'] = $this->products->getAll();
        $this->view('products/index', $data);
    }

    public function single($id){
        $data['product'] = $this->products->getSingle($id);
        $this->view('products/single', $data);
    }
}