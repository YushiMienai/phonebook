<?php

define("ROOT", "../" );
define("CONTROLLER_PATH", ROOT . "controllers/");
define("MODEL_PATH", ROOT . "models/");
define("VIEW_PATH", ROOT . "views/");

require_once("DB.php");
require_once("Router.php");
require_once("Configuration.php");
require_once MODEL_PATH . 'Model.php';
require_once CONTROLLER_PATH . 'Controller.php';
require_once VIEW_PATH . 'View.php';

$models = scandir(MODEL_PATH);
foreach($models as $model){
    if ($model != '.' && $model != '..'){
        require_once MODEL_PATH . $model;
    }
}

$controllers = scandir(CONTROLLER_PATH);
foreach($controllers as $controller){
    if ($controller != '.' && $controller != '..'){
        require_once CONTROLLER_PATH . $controller;
    }
}

Router::buildRoute();