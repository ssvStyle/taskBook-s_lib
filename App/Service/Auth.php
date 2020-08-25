<?php

namespace App\Service;

use App\Models\Authorization;
use App\Models\Db;

class Auth
{

    public static function set($post)
    {
        $err = [];

        if (empty(trim($post["Login"])) || empty($post["pass"])) {
            $err[] = 'Все поля должны быть заполненны';
        } else {
            $auth = new Authorization(new Db());
            if ($auth->loginExist($post["Login"])) {
                if ($auth->loginAndPassValidation($post["Login"], $post["pass"])) {
                    $auth->setAuth();
                    return true;
                } else {
                    $err[] = 'Логин и/или пароль не верны';
                }
            } else {
                $err[] = 'Пользователя с таким логином не существует';
            }
        }

        return $err;

    }

    public static function unsetSession()
    {

        $auth = new Authorization(new Db());
        $auth->exitAuth();

    }

}