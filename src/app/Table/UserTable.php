<?php

namespace App\Table;

class UserTable extends \Core\Table\Table
{


    public function findUserEmail($email)
    {
        return $this->query('SELECT * FROM user WHERE email = ?', [$email], null, true);
    }

    public function find($id)
    {
        return $this->query('SELECT * FROM user WHERE id = ?', [$id], null, true);
    }

    public function all()
    {
        return $this->query(
            "SELECT user.id, user.email, DATE_FORMAT(user.confirmed_at, '%d/%m/%y à %hh%m') AS creation_date, 
            role.name AS role_name 
            FROM user
            LEFT JOIN role
                ON user.user_role = role.id"
        , null, null, false);
    }
}