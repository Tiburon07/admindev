<?php

namespace app\traits;

use Exception;

trait Create
{
    public function create(array $createFieldsAndVAlues){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try{
            $sql = sprintf("INSERT INTO %s (%s) values(%s)",
                $this->table,
                implode(',', array_keys($createFieldsAndVAlues)),
                ':'.implode(',:', array_keys($createFieldsAndVAlues)));
            $stmt = $this->conn->prepare($sql);

            $result['data'] = $stmt->execute($createFieldsAndVAlues);
        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

}