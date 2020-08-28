<?php
namespace App\Controllers;
use Core\BaseController;
use App\Models\Db;

class Task extends BaseController
{
    /**
     *
     */
    public function add()
    {
        $task = new \App\Models\Task();

        $task->name = $_POST['name'] ?? '';
        $task->email = $_POST['email'] ?? '';
        $task->job = $_POST['job'] ?? '';
        $task->status_id = $_POST['status'] ?? '';
        $task->admin_edit = 0;

        //$task->save();

        $db = new Db();
        $sql = 'SELECT * FROM status';
        //echo '<pre>';
        //var_dump($db->query($sql, []));
        //echo '<pre>';
        //die;
        echo $this->view->display('addNewTask.html', [
            'task' => $task,
            'statuses' => $db->query($sql, []),
        ]);
    }

    /**
     *
     */
    public function edit()
    {
        var_dump($_POST);
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