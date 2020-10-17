<?php

class Controller
{
    protected $model;
    protected $view;
    protected $layout;
    protected $pageData = array();

    public function __construct() {
        $this->layout = 'main';
        $this->view = new View();
        $this->model = new Model();
    }

    public function isLogged(){
        if (isset($_SESSION['login'])) return true;
        else return false;
    }

    public function redirect($url){
        header("Location: " . $url);
    }
}