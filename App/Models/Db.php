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
        return  $sth->fetchAll(\PDO::FETCH_COLUMN, 0);
    }

    public function queryRetObj($sql, $data = [], $class)
    {
        //$this->dbh->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
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