<?php

namespace App\Service;

use App\Models\Task;

/**
 * Class TaskValid
 * Validation field task
 *
 *
 * @package App\Service
 */
class TaskValid
{
    /**
     * fill all fields
     *
     * @var object Task
     */
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;

    }

    /**
     * validation name field
     *
     * @return bool
     *
     */

    public function fieldName()
    {
        if (iconv_strlen($this->task->name) < 3) {
            return false;
        }
        return true;
    }


    /**
     * validation email field
     *
     * @return bool
     *
     */

    public function fieldEmail()
    {
        return filter_var($this->task->email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * validation job field
     *
     * @return bool
     *
     */
    public function fieldJob()
    {
        if (iconv_strlen($this->task->job) < 20) {
            return false;
        }
        return true;
    }

    /**
     * validation status field
     *
     * @return bool
     *
     */

    public function fieldStatus()
    {

    }

}