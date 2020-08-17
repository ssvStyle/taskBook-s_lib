<?php

namespace App\Models;

use App\Models\Model;

class Task extends Model
{
    const TABLE = 'tasks';

    public $name, $email, $job, $status;

}