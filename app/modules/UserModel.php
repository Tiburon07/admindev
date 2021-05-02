<?php

namespace app\modules;
use Exception;

class UserModel extends BaseModel
{
    protected $table = 'users';

    public function getUsers(){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try {
            $query = $this->conn->query("SELECT id, username, email FROM {$this->table}");
            $result['data'] = $query->fetchAll();
        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
}