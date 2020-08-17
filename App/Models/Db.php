<?php

namespace App\Models;


class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = (include __DIR__ . '/../../config/db.php');
        $this->dbh = new \PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'].';charset=utf8', $config['user'], $config['pass']);
    }

    public function query($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return  $sth->fetchAll();
    }

    public function queryRetObj($sql, $data = [], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return  $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }

    public function getLastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}