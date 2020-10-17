<?php


class UserModel extends Model
{
    private $table = "users";

    public function save($user){
        $user['password'] = self::genPassword($user['password'], $user['login']);
        $fields = array(
            "login" => $user['login'],
            "email" => $user['email'],
            "password" => $user['password']
        );
        $id = $this->db->insert($this->table, $fields);
        if ($id != null){
            $_SESSION['login'] = $user['login'];
            return $id;
        }
        else{
            return false;
        }
    }

    public function findByLogin($login){
        $conditions = array("login" => $login);
        return $this->db->select($this->table, $conditions);
    }

    public static function genPassword($word, $login){
        return md5($word . $login . Configuration::get('hashkey'));
    }
}