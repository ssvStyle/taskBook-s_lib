<?php

namespace App\Controllers;

use App\Servise\Auth;
use Core\BaseController;
use App\Models\Authorization as AuthModel;
use App\Models\Db;


class Authorization extends BaseController
{

    public function login()
    {

        $auth = new AuthModel(new Db());

        if ($auth->userVerify()) {
            header('Location: home');
        }
        echo $this->view
            ->display('auth/login.html');
    }

    public function signIn()
    {

        Auth::set($_POST);
        header('Location: home');

    }

    public function unsetSession()
    {
        Auth::unsetSession();
        header('Location: login');

    }

}