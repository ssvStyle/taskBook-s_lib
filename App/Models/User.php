<?php

namespace App\Models;
use Core\Model;

class User extends Model
{
    const TABLE = 'users';

    public $id, $login, $pass, $sessionHash, $status;

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

}