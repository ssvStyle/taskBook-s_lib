<?php

namespace App\Controllers;

use App\Service\Task;
use Core\BaseController;

class Home extends BaseController
{

    public function index()
    {

        $pageNum = $this->data['pageNum'] ?? 1;

        $field = $this->data['field'] ?? 'name';
        $sort = $this->data['sort'] ?? 'desc';
        $page = Task::getPage((int)$pageNum, $field, $sort);

        echo $this->view
            ->render('index.html', [
                'paginError' => $page['errors']['paginError'] ?? '',
                'tasks' => $page['tasks'],
                'numberOfPages' => $page['pageNums'],
                'nextPage' => $page['nextPage'],
                'curentPage' => $page['curentPage'],
                'prevPage' => $page['previosPage'],
                'firstPage' => 1,
                'from' => $page['from'],
                'too' => $page['too'],
                'lastPage' => $page['lastPage'],
                'url' => 'field/' . $field . '/sort/' . $sort,
                'sort' => $sort,
            ]);

    }


}