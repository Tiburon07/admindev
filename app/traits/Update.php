<?php


namespace app\traits;
use Exception;

trait Update
{

    public function update(array $updateFieldsAndValues ){
        $result = ['data' => null, 'status' => 0, 'message' => ''];
        try{
            $fields = $updateFieldsAndValues['fields'];
            $where = $updateFieldsAndValues['where'];
            $updateFields = '';

            foreach (array_keys($fields) as $keyField)
                $updateFields .= "{$keyField} = :{$keyField}, ";

            $updateFields = rtrim($updateFields,', ');
            $whereUpdate = array_keys($where);
            $bind = array_merge($fields, $where);
            $sql = sprintf('UPDATE %s set %s where %s', $this->table, $updateFields, "{$whereUpdate[0]} = :{$whereUpdate[0]}");
            $stmt = $this->conn->prepare($sql);
            $result['data'] =  $stmt->execute($bind);

        }catch (Exception $e){
            $result['status'] = 1;
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

}