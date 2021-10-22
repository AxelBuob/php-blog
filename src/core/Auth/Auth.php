<?php

namespace Core\Auth;
use Core\Database\MysqlDatabase;

class Auth
{
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    } 
    
    /**
     * Undocumented function
     * @param $username
     * @param $password
     * @return boolean
     */
    public function login($email, $password)
    {
        $user = $this->db->prepare('SELECT * FROM user WHERE email = ?', [$email], null, true);
        if($user)
        {
            if(password_verify($password, $user->password))
            {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }
    }

    public function logged()
    {
        return isset($_SESSION['auth']); 
    }

    public function getUserId()
    {
        if($this->logged())
        {
            return $_SESSION['auth'];
        }
    }

    public function logout()
    {
        
    }
}