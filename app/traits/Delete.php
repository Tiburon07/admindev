<?php

namespace app\traits;

use Exception;

trait Delete
{
    public function delete($field, $value){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try{
            $sql = "DELETE FROM {$this->table} where {$field} = :{$field}";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":{$field}", $value);
            $result['data'] = $stmt->execute();

        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

}