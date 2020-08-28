<?php

namespace App\Models;

use Core\Model;

class Task extends Model
{
    const TABLE = 'tasks';

    public $name, $email, $job, $status_id, $admin_edit;

}