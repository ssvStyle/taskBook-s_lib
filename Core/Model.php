<?php

namespace Core;
use App\Models\Db;

abstract class Model
{
    public const TABLE = '';
    public $id;
    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query(
            $sql,
            [],
            static::class
        );
    }

    public static function findById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';

        $result = $db->query(
            $sql,
            [':id' => $id],
            static::class
        );

        if (empty($result)){
            return false;
        }
        return $result[0];
    }

    public function insert()
    {
        $fields = get_object_vars($this);

        $cols = [];
        $data = [];

        foreach ($fields as $name => $value){
            if ($name == 'id'){
                continue;
            }
            $cols[] = $name;
            $data[':' . $name] = $value;
        }

        $sql  = 'INSERT INTO ' . static::TABLE . ' (' . implode(',', $cols) . ') VALUES (' . implode(',',array_keys($data)) . ')';

        $db = new Db();
        $rez = $db->execute($sql, $data);
        $this->id = $db->getLastInsertId();
        return $rez;
    }

    public function update()
    {
        $fields = get_object_vars($this);

        $cols = [];
        $data = [];

        foreach ($fields as $name => $value){
            if ($name == 'id'){
                continue;
            }
            $cols[] = $name . '=:' . $name;
            $data[$name] = $value;
        }
        $sql  = 'UPDATE ' . static::TABLE . ' SET '.implode(',',$cols).'  WHERE id=' . $this->id;
        $db = new Db();
        return $db->execute($sql, $data);
    }

    public function save()
    {
        if (static::findById($this->id)){
            $rez = $this->update();
        } else {
            $rez = $this->insert();
        }
        return $rez;
    }

    public function delete()
    {
        $sql = 'DELETE FROM '.static::TABLE.' WHERE id=:id';
        $data[':id'] = $this->id;
        $db = new Db();
        $db->execute($sql, $data);
    }

    /*private function erors($sql, $db)
    {
        if ($db->errorCode() !== '00000'){
            throw new DbExep('', 'Ошибка запроса - '. $sql);
        }
    }*/
}