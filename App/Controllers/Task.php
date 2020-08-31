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

            if ($data['saveStatus']) {
                $_SESSION['saveStatus'] = 'Задача добавленна';
                header('Location: /taskBook-s_lib');
            }

            echo $this->view->display('addNewTask.html', [
                'task' => $data['task'],
                'statuses' => ServiceTask::getStatus(),
                'errors' => $data['errors'],
            ]);

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

        $auth = new \App\Models\Authorization(new Db());
        $this->access($auth->userVerify());

        if ($_POST) {
            $data = ServiceTask::add($_POST);

            if ($data['saveStatus']) {
                $_SESSION['saveStatus'] = 'Задача отредактирована';
                header('Location: /taskBook-s_lib');
            }


            echo $this->view->display('addNewTask.html', [
                'task' => $data['task'],
                'statuses' => ServiceTask::getStatus(),
                'errors' => $data['errors'],
            ]);


        } else {
            echo $this->view->display('addNewTask.html', [
                'task' => ServiceTask::getTask((int)$this->data['id'])[0],
                'statuses' => ServiceTask::getStatus(),
            ]);
        }


    }

}