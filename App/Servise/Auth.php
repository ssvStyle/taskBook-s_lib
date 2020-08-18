<?php

namespace App\Servise;

use App\Models\Authorization;
use App\Models\Db;

class Auth
{

    public static function set($post)
    {

        if ($post["Login"] == '' && $post["pass"] == '') {
            return false;
        }

        $auth = new Authorization(new Db());

        if ($auth->loginAndPassValidation($post["Login"], $post["pass"])) {
            $auth->setAuth();
        }

    }

    public static function unsetSession()
    {

        $auth = new Authorization(new Db());
        $auth->exitAuth();

    }

}