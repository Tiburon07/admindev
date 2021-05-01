<?php


namespace app\classes;


class Validate
{
    private $error = [];

    public function required(array $fields){
        foreach ($fields as $field){
            if(empty($_POST[$field])){
                $this->error[$field] = 'Il campo è obbligatorio';
            }
        }
        return $this;
    }

    public function exist($model, $field, $value){
        $data = $model->findBy($field, $value);
        if($data){
            $this->error[$field] = 'Email già utilizzata';
        }
        return $this;
    }

    public function email($email){
        $validated = filter_var($email, FILTER_VALIDATE_EMAIL);
        if(!$validated){
            $this->error['email'] = 'Email non valida';
        }
    }

    public function getErrors(){
        return $this->error;
    }
}