<?php

class Model
{
    protected $db = null;

    public function __construct() {
        $host = Configuration::get('database.host');
        $user = Configuration::get('database.user');
        $pass = Configuration::get('database.pass');
        $name = Configuration::get('database.name');

        $this->db = DB::getInstance($host, $user, $pass, $name);
    }
}