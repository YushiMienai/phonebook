<?php


class Configuration
{
    private static $instance = null;
    private $configs;

    private function __construct() {
        $this->configs = include("../config.php");
    }

    private function __clone() { }

    public static function get($name){
        if (!isset(self::$instance)) {
            self::$instance = new Configuration();
        }

        $name = explode(".", $name);
        $property = self::$instance->configs[$name[0]];
        for($i = 1; $i < count($name); $i++){
            $property = $property[$name[$i]];
        }
        return $property;
    }
}