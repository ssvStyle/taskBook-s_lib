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

    /**
     * @param $sql
     * @param array $data
     * @return array
     */
    public function query($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return  $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $sql
     * @param array $data
     * @param $class
     * @return array
     */
    public function queryRetObj($sql, $data = [], $class)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($data);
        return  $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @param $sql
     * @param array $data
     * @return bool
     */
    public function execute($sql, $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($data);
    }

    /**
     * @return string
     */
    public function getLastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}