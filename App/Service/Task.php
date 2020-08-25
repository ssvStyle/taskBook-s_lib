<?php

namespace App\Service;
use App\Models\Db;
use App\Models\Pagination;


class Task
{
    public static function getPage($page, $field, $sort)
    {
        $data = [];
        $data['errors'] = [];
        $db = new Db();

        $pagin = new Pagination($db, 'tasks', 3);

        if ($page > $pagin->getPageNums() || $page == 0) {
            $page = 1;
            $data['errors']['paginError'] = 'Страницы с таким номером не существует!';
        }

        $fromTo = $pagin->setPage($page)->getFromToByPage($page);

        $sql = 'SELECT tasks.id, name, email, job, status.status_name as status, admin_edit 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                ORDER BY ' . $field . ' ' . $sort . '
                LIMIT ' . (int)$fromTo['from'] . ', ' . (int)$fromTo['to'];

        $loopPaginfrom = 1;
        if ( $page - 2 > 0 ) {
            $loopPaginfrom = $page - 2;
        }

        $loopPagintoo = $page + 2;
        if ( $page + 2 >= $pagin->getPageNums() ) {
            $loopPagintoo = $pagin->getPageNums();
        }


        $data['tasks'] = $db->queryRetObj($sql, [], 'App\Models\Task');
        $data['pageNums'] = $pagin->getPageNums();
        $data['curentPage'] = $page;
        $data['nextPage'] = $pagin->getNextPage();
        $data['previosPage'] = $pagin->getPrevPage();
        $data['firstPage'] = 1;
        $data['from'] = $loopPaginfrom;
        $data['too'] = $loopPagintoo;
        $data['lastPage'] = $pagin->getPageNums();

        return $data;

    }

}