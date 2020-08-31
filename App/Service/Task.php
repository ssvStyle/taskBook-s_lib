<?php

namespace App\Service;
use App\Models\Db;
use App\Models\Task as TaskModel;
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

    public static function add($post)
    {
        $errors = [];
        $saveStatus = false;

        $task = new \App\Models\Task();
        $task->id = $post['id'] ?? '';
        $task->name = $post['name'] ?? '';
        $task->email = $post['email'] ?? '';
        $task->job = $post['job'] ?? '';
        $task->status_id = $post['status'] ?? '';

        $task->admin_edit = 0;


        $taskValid = new TaskValid($task);
        if (!$taskValid->fieldName()) {
            $errors['name'] = 'Пустое или слишком поле Имя';
        }

        if (!$taskValid->fieldEmail()) {
            $errors['email'] = 'Пустое поле или некорректный Email';
        }

        if (!$taskValid->fieldJob()) {
            $errors['job'] = 'Пустое или слишком поле Задача';
        }



        if (empty($errors)) {
            if (!empty($task->id)) {
                $taskModel = new TaskModel();
                $oldTask = $taskModel::findById((int)$task->id);

                $cond = ($task->name != $oldTask['name'] || $task->email != $oldTask['email'] || $task->job != $oldTask['job'] || $task->status_id != $oldTask['status_id']);

                if ($cond) {
                    $task->admin_edit = true;
                }
            }

            $saveStatus = $task->save();
        }

        return ['task' => $task, 'errors' => $errors, 'saveStatus' => $saveStatus];

    }

    public static function getStatus()
    {
        $db = new Db();

        $sql = 'SELECT * FROM status';

        return $db->query($sql, []);
    }

    public static function getTask(int $id)
    {
        $db = new Db();
        $sql = 'SELECT tasks.id, name, email, job, status.status_name as status, admin_edit 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                WHERE tasks.id = :id';

        return $db->queryRetObj($sql, ['id' => $id],'App\Models\Task');
    }

}