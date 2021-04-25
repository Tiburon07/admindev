<?php


namespace app\classes;


class Validate
{
    private $error = [];

    public function exists(array $fields){
        foreach ($fields as $field){
            if(empty($_POST[$field])){
                $this->error[$field] = 'Il campo è obbligatorio';
            }
        }

        return $this;
    }

    public function email($model, $field, $value){
        $user = $model->findBy($field, $value);
        if($user){
            $this->error[$field] = 'La mail è gai utilizzata';
        }
    }

    public function getErrors(){
        return $this->error;
    }
}