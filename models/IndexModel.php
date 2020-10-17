<?php

class IndexModel extends Model
{
    private $table = "phones";

    public function savePhone($phone){
        $fields = array(
            "user_id" => $phone['user_id'],
            "name" => $phone['name'],
            "lastname" => $phone['lastname'],
            "phone" => $phone['phone'],
            "email" => $phone['email']
        );
        return $this->db->insert($this->table, $fields);
    }

    public function saveImage($id, $fileSrc){
        $fields = array(
            "pic" => $fileSrc
        );
        $this->db->update($this->table, $id, $fields);
    }

    public function getAllByUser($userId){
        if ($userId == null) return null;
        else {
            $whereArray = array("user_id" => $userId);
            $result = $this->db->selectAll($this->table, $whereArray);
            $return = array();
            foreach($result as $row){
                $return[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'lastname' => $row['lastname'],
                    'phone' => $row['phone'],
                    'email' => $row['email']
                );
            }

            return $return;
        }
    }

    public function delByIdAndUserid($id, $userId){
        if($id == null || $userId == null) return false;
        else{
            $conditions = array(
                "id" => $id,
                "user_id" => $userId
            );
            return $this->db->delete($this->table, $conditions);
        }
    }

    public function getByIdAndUserid($id, $userId){
        if($id == null || $userId == null) return null;
        else{
            $whereArray = [
                "id" => $id,
                "user_id" => $userId
            ];
            $result = $this->db->select($this->table, $whereArray);
            return $result;
        }
    }
}