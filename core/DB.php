<?php

class DB
{
    private static $instance = null;
    private $conn;

    private function __construct($host, $user, $pass, $db) {
        if ($this->conn == null) {
            $this->conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        }
        return $this->conn;
    }

    public static function getInstance($host, $user, $pass, $db)
    {
        if(!self::$instance) {
            self::$instance = new DB($host, $user, $pass, $db);
        }

        return self::$instance;
    }

    private function execute($sql, $arrayExecute = null){
        $stmt = $this->conn->prepare($sql);
        try{
            $this->conn->beginTransaction();
            $stmt->execute($arrayExecute);
            $id = $this->conn->lastInsertId();
            $this->conn->commit();
            return $id;
        }catch (Exception $e){
            $this->conn->rollback();
            $_SESSION['error'] = $e->getMessage();
            return null;
        }
    }

    private function makeWhereClause($conditions){
        $whereClause = '';
        $whereArray = array();
        foreach($conditions as $key => $value){
            $whereArray[] = "$key = '$value'";
        }
        if(count($conditions) > 0){
            $whereClause = " where " . implode(" and ", $whereArray);
        }
        return $whereClause;
    }

    private function prepareSelect($table, $conditions){
        $whereClause = $this->makeWhereClause($conditions);
        $sql = "select * from ". $table . $whereClause;

        return $this->conn->prepare($sql);
    }

    public function select($table, $conditions){
        $stmt = $this->prepareSelect($table, $conditions);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAll($table, $conditions){
        $stmt = $this->prepareSelect($table, $conditions);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert($table, $fields){
        $keys = array();
        $values = array();
        $arrayExecute = array();
        foreach($fields as $key => $value){
            $keys[] = $key;
            $values[] = ":" . $key;
            $arrayExecute[":" . $key] = $value;
        }
        $sql = "insert into " . $table . " (" . implode(", ", $keys) . ") values (" . implode(", ", $values) . ")";
        return $this->execute($sql, $arrayExecute);
    }

    public function update($table, $id, $fields){
        $arrayExecute = array(
            ":id" => $id
        );
        $values = array();
        foreach($fields as $key => $value){
            $arrayExecute[":" . $key] = $value;
            $values[] = $key . " = :" . $key;
        }
        $sql = "update " . $table . " set " . implode(", ", $values) . " where id = :id";
        $this->execute($sql, $arrayExecute);
    }

    public function delete($table, $conditions){
        $whereClause = $this->makeWhereClause($conditions);
        $sql = "delete from " . $table . $whereClause;
        if ($this->execute($sql) != null) {
            return 1;
        }
        else {
            return null;
        }
    }
}