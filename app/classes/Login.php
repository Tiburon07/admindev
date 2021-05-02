<?php


namespace app\classes;

use \app\modules\UserModel;

class Login
{
    public function login($email, $password){
        $user = new UserModel();
        $result = $user->findBy('email', $email);

        if($result['status'] || !$result['data']){
            return false;
        }

        if(password_verify($password,$result['data']->password)){
            $_SESSION['user_logged_data'] = [
                'username' => $result['data']->username,
                'id_user' => $result['data']->id,
                'email' => $result['data']->email,
                'roletype' => $result['data']->roletype
            ];
            $_SESSION['is_logged_in'] = true;
            return true;
        }

        return false;
    }

    public function logout(){
        session_destroy();
    }
}