<?php

namespace App\Servise;
use App\Models\Db;
use App\Models\Pagination;


class Task
{
    public static function getPage($page, $field, $sort)
    {
        $db = new Db();

        $pagin = new Pagination($db, 'tasks');
        $fromTo = $pagin->setLimit(3)->setPage($page)->getFromToByPage($page);


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
            $too = $pagin->getPageNums();
        }

        //var_dump($db->queryRetObj($sql, [], 'App\Models\Task'));die;

        return [
            'tasks' => $db->queryRetObj($sql, [':from' => (int)$fromTo['from'], ':too' => (int)$fromTo['to'], ':field' => $field, ':sort' => $sort], 'App\Models\Task'),
            'pageNums' => $pagin->getPageNums(),
            'curentPage' => $page,
            'nextPage' => $pagin->getNextPage(),
            'previosPage' => $pagin->getPrevPage(),
            'firstPage' => 1,
            'from' => $loopPaginfrom,
            'too' => $loopPagintoo,
            'lastPage' => $pagin->getPageNums(),
        ];

    }

}