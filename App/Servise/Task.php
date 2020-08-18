<?php

namespace App\Servise;
use App\Models\Db;
use App\Models\Pagination;


class Task
{
    public static function getPage($page)
    {
        $db = new Db();

        $pagin = new Pagination($db, 'tasks');
        $fromTo = $pagin->setLimit(3)->setPage($page)->getFromToByPage($page);


        $sql = 'SELECT tasks.id, name, email, job, status.status_name as status, admin_edit 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                LIMIT ' . $fromTo['from'] . ', ' . $fromTo['to'];

        //return $db->queryRetObj($sql, [], 'App\Models\Task');
        $from = 1;
        if ( $page - 2 > 0 ) {
            $from = $page - 2;
        }

        $too = $page + 2;
        if ( $page + 2 >= $pagin->getPageNums() ) {
            $too = $pagin->getPageNums();
        }

        return [
            'tasks' => $db->queryRetObj($sql, [], 'App\Models\Task'),
            'pageNums' => $pagin->getPageNums(),
            'curentPage' => $page,
            'nextPage' => $pagin->getNextPage(),
            'previosPage' => $pagin->getPrevPage(),
            'firstPage' => 1,
            'from' => $from,
            'too' => $too,
            'lastPage' => $pagin->getPageNums(),
        ];

    }

}