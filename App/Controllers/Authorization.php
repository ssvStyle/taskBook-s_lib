<?php

namespace App\Controllers;

use App\Service\Auth;
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

        if (empty($_POST)) {
            echo $this->view->display('auth/login.html');
        } else {
            $result = Auth::set($_POST);
            if ($result === true) {
                header('Location: home');
            } else {
                echo $this->view->render('auth/login.html', [
                    'errors' => $result,
                    'login' => $_POST['Login'] ?? '',
                ]);
            }
        }

    }

    public function unsetSession()
    {
        Auth::unsetSession();
        header('Location: home');

    }

}