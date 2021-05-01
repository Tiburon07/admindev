<?php


namespace app\traits;


use PDOException;

trait Read
{
    public function find($fetchAll = true){
        try {

            $query = $this->conn->query("SELECT * FROM {$this->table}");
            return $fetchAll ? $query->fetchAll() : $query->fetch();

        }catch (PDOException $e){
            var_dump($e->getMessage());
        }
    }

    public function findBy($field, $value,$fetchAll = false ){
        try {

            $prepare = $this->conn->prepare("SELECT * FROM {$this->table} WHERE {$field} = :{$field} ");
            $prepare->bindValue(":{$field}", $value);
            $prepare->execute();

            return $fetchAll ? $prepare->fetchAll() : $prepare->fetch();

        }catch (PDOException $e){
            var_dump($e->getMessage());
            die();
        }
    }

}