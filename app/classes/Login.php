<?php


namespace app\classes;


use \app\database\modules\User;

class Login
{
    public function login($email, $password){
        $user = new User();
        $userFound = $user->findBy('email', $email);
        if(!$userFound){
            return false;
        }

        if(password_verify($password,$userFound->password)){
            $_SESSION['user_logged_data'] = [
                'username' => $userFound->username,
                'email' => $userFound->email
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