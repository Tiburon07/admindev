<?php


namespace app\traits;
use Exception;

trait Read
{
    public function find($fetchAll = true){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try {
            $query = $this->conn->query("SELECT * FROM {$this->table}");
            $result['data'] = $fetchAll ? $query->fetchAll() : $query->fetch();
        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function findBy($field, $value,$fetchAll = false ){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try {
            $prepare = $this->conn->prepare("SELECT * FROM {$this->table} WHERE {$field} = :{$field} ");
            $prepare->bindValue(":{$field}", $value);
            $prepare->execute();
            $result['data'] = $fetchAll ? $prepare->fetchAll() : $prepare->fetch();
        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

}