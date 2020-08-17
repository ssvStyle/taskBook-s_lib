<?php

namespace App\Controllers;

use App\Servise\Task;
use Core\BaseController;

class Home extends BaseController
{

    public function index()
    {

        $page = $this->data['pageNum'] ?? 1;
        $field = $this->data['field'] ?? 'name';
        $sort = $this->data['sort'] ?? 'desc';

        $this->view->addGlobal('tasks', Task::getPage($page));
        echo $this->view
            ->render('index.html');

    }


}