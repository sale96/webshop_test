<?php


class Core
{
    //Defining controller, method, and params if exist
    protected $current_controller = 'Pages';
    protected $current_method = 'index';
    protected $args = [];

    public function __construct()
    {
        $link = $this->getLink();

        if(file_exists('controllers/'.$link[0].'.php')){
            //If file exist current controller would be a name of that class or file
            $this->current_controller = $link[0];
            unset($link[0]);
        }

        //Requiring that controller and instantiating it
        require_once 'controllers/'.$this->current_controller.'.php';
        $this->current_controller = new $this->current_controller;

        //checking if method exists, if not default is index
        if(isset($link[1])) {
            if (method_exists($this->current_controller, $link[1])) {
                $this->current_method = $link[1];
                unset($link[1]);
            }
        }

        //If there is anything left in $links array it would be placed inside $args array, everything else is treated as params
        $this->args = $link ? array_values($link) : [];

        //Now to call everything
        call_user_func_array([$this->current_controller, $this->current_method], $this->args);
    }

    //Function for getting link eg. index.php?page=Pages/index/1
    private function getLink(){
        if(isset($_GET['page'])){
            $link = $_GET['page'];

            //Trim whitespace
            $link = trim($link, '');
            $link = filter_var($link, FILTER_SANITIZE_URL);
            $link = explode('/', $link);

            //Returns array as index.php?page=current_controller/current_method/args
            return $link;
        }
    }
}