<?php


namespace app\traits;
use PDOException;

trait Create
{
    public function create(array $createFieldsAndVAlues){
        try{

            $sql = sprintf("INSERT INTO %s (%s) values(%s)",
                $this->table,
                implode(',', array_keys($createFieldsAndVAlues)),
                ':'.implode(',:', array_keys($createFieldsAndVAlues)));

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($createFieldsAndVAlues);


        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }

}