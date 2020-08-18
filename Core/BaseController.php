<?php

namespace Core;

use App\View;
use Core\Interfaces\BaseController as BaseControllerInterfase;
use App\Models\Authorization as AuthModel;
use App\Models\Db;

abstract class BaseController implements BaseControllerInterfase
{
    /*
     *$data for transfer to all classes of controllers
     */

    public $data;

    /*
     *$view obj for transfer to all classes of controllers
     */

    public $view;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');

        $this->view = new \Twig\Environment($loader, [
            'cache' => 'cache',
            'auto_reload' => true
            ]);

        $auth = new AuthModel(new Db());
        //var_dump($auth->userVerify());die;
        $this->view->addGlobal('User', $auth->userVerify());
        $this->view->addGlobal('userName', '');
        $this->view->addGlobal('userStatus', '');
        $this->view->addGlobal('host', require __DIR__.'/../config/host.php');
    }

    /**
     * @param array $data
     */
    public function setData(array $data = [])
    {
        $this->data = $data;
    }

}