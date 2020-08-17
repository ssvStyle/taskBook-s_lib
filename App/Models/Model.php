<?php

namespace App\Models;

abstract class Model
{

    public const TABLE = '';

    public $id;

    public static function findAll()
    {
        $db = new Db();
        return $db->query('SELECT * FROM ' . static::TABLE,
            [],
            static::class
        );
    }

    public static function findById($id){
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $result = $db->query($sql, [':id'=>$id],static::class);
        if ($result == null){
            return false;
        }
        return $result[0];
    }

}