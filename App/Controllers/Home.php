<?php

namespace App\Controllers;

use Core\BaseController;

class Home extends BaseController
{

    public function index()
    {

        echo $this->view
            ->render('index.html.twig');

    }


}