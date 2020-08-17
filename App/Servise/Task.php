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
        $fromTo = $pagin->setLimit(3)->getFromToByPage($page);


        $sql = 'SELECT tasks.id, name, email, job, status.status_name as status, admin_edit 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                LIMIT ' . $fromTo['from'] . ', ' . $fromTo['to'];

        return $db->queryRetObj($sql, [], 'App\Models\Task');

    }

}