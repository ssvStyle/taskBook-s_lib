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

        $page = Task::getPage($page);
        $this->view->addGlobal('tasks', $page['tasks']);
        $this->view->addGlobal('numberOfPages', $page['pageNums']);
        $this->view->addGlobal('nextPage', $page['nextPage']);
        $this->view->addGlobal('curentPage', $page['curentPage']);
        $this->view->addGlobal('prevPage', $page['previosPage']);
        $this->view->addGlobal('firstPage', 1);
        $this->view->addGlobal('from', $page['from']);
        $this->view->addGlobal('too', $page['too']);
        $this->view->addGlobal('lastPage', $page['lastPage']);


        echo $this->view
            ->render('index.html');

    }


}