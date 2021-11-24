<?php

namespace Core\Auth;

class Auth
{
    public function logged()
    {
        return isset($_SESSION['user_id']); 
    }

    public function getUserId()
    {
        if($this->logged())
        {
            return $_SESSION['user_id'];
        }
    }

    public function isAdmin()
    {
        if($this->logged())
        {
            if($_SESSION['user_role'] == 1)
            {
                return true;
            }
        }
    }

    public function createToken()
    {
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        return $token;
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function checkPassword($password, $db_password) 
    {
        return password_verify($password, $db_password);
    }

}
