<?php


namespace app\traits;
use PDOException;

trait Delete
{
    public function delete($field, $value){
        try{

            $sql = "DELETE FROM {$this->table} where {$field} = :{$field}";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":{$field}", $value);
            return $stmt->execute();

        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }

}