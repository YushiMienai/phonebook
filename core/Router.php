<?php

class Router
{
    public static function buildRoute(){
        $controllerName = "IndexController";
        $action = "actionIndex";

        $route = explode("/", $_SERVER['REQUEST_URI']);

        if($route[1] != ''){
            $controllerName = ucfirst($route[1]. "Controller");
        }

        if(isset($route[2]) && $route[2] !='') {
            $action = "action" . ucfirst($route[2]);
        }

        $args = null;
        if(count($route) > 3){
            $args = array();
            for ($i = 3; $i < count($route); $i++) $args[] = $route[$i];
        }

        $controller = new $controllerName();
        $controller->$action($args);
    }
}