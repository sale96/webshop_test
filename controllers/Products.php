<?php


class Products extends Controller
{
    public function index(){
        $this->view('products/index');
    }

    public function single($id){
        $this->view('products/single');
    }
}