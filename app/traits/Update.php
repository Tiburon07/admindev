<?php


namespace app\traits;


trait Update
{

    public function update(array $updateFieldsAndValues ){
        try{
            $fields = $updateFieldsAndValues['fields'];
            $where = $updateFieldsAndValues['where'];

            $updateFields = '';
            foreach (array_keys($fields) as $keyField){
                $updateFields .= "{$keyField} = :{$keyField}, ";
            }
            $updateFields = rtrim($updateFields,', ');

            $whereUpdate = array_keys($where);
            $bind = array_merge($fields, $where);

            $sql = sprintf('UPDATE %s set %s where %s', $this->table, $updateFields, "{$whereUpdate[0]} = :{$whereUpdate[0]}");

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($bind);


        }catch(PDOException $e){
            var_dump($e->getMessage());
        }

    }

}