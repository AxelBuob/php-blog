<?php

namespace App\Table;

class UserTable extends \Core\Table\Table
{

    public function findUserEmail($email)
    {
    return $this->query('SELECT * FROM user WHERE email = ?', [$email], null, true);
    }

    public function findUserName($name)
    {
        return $this->query('SELECT * FROM user WHERE name = ?', [$name], null, true);
    }
}