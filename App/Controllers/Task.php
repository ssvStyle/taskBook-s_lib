<?php
namespace App\Controllers;
use Core\BaseController;
use App\Models\Db;
use App\Service\Task as ServiceTask;

class Task extends BaseController
{
    /**
     *
     *
     */
    public function add()
    {
        if ($_POST) {
            $data = ServiceTask::add($_POST);

            echo $this->view->display('addNewTask.html', [
                'task' => $data['task'],
                'statuses' => ServiceTask::getStatus(),
                'errors' => $data['errors'],
            ]);


            if ($data['saveStatus']) {
                $_SESSION['saveStatus'] = 'Задача добавленна';
                header('Location: /taskBook-s_lib');
            }

        } else {
            echo $this->view->display('addNewTask.html', [
                'statuses' => ServiceTask::getStatus(),
            ]);
        }

    }

    /**
     *
     */
    public function edit()
    {
        //var_dump($_POST);
        $db = new Db();
        $sql = 'SELECT tasks.id, name, email, job, status.status_name as status, admin_edit 
                FROM tasks
                LEFT JOIN status ON tasks.status_id = status.id
                WHERE tasks.id = :id';

        $auth = new \App\Models\Authorization($db);
        //var_dump($db->queryRetObj($sql, [':id' => (int)$this->data['id']], 'App\Models\Task')[0]);die;
        $this->access($auth->userVerify());
        echo $this->view->display('addNewTask.html', [
            'task' => $db->queryRetObj($sql, [':id' => (int)$this->data['id']], 'App\Models\Task')[0],
        ]);
    }

}