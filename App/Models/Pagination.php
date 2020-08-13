<?php

namespace App\Models;

use App\Db;

class Pagination
{
    protected $limit;
    protected $count;
    protected $db;
    protected $page;

    public function __construct(Db $db)
    {
        $this->db = new $db;
        $sql = 'SELECT COUNT(*) FROM tasks';
        $this->count =  (int)$db->simpleQuery($sql) ["COUNT(*)"];

    }

    /**
     * @param int $limit
     *
     * @return object
     */
    public function setLimit( $limit )
    {
        $this->limit = $limit;
        return $this;

    }

    /**
     * @param int $page
     *
     */
    public function setPage($page)
    {

        $this->page = $page;

    }

    /**
     * @param int $page
     *
     * @return array|object
     */
    public function getPageData($page)
    {
        if ($page <= 1) {

            $start = 0;

        } else {

            $start = 0;
            $page--;

            while ($page > 0 ) {

                $start += $this->limit;
                $page--;

            }
        }

        $sql = 'SELECT * FROM tasks LIMIT ' . $start . ', ' . $this->limit;

        return $this->db->query($sql, [] , '\App\Models\Task');

    }

    /**
     * @param int $page
     *
     * @return array|object
     */
    public function getPageDataSortBy($page, $sortType, $field)
    {
        if ($page <= 1) {

            $start = 0;

        } else {

            $start = 0;
            $page--;

            while ($page > 0 ) {

                $start += $this->limit;
                $page--;

            }
        }

        $sql = 'SELECT * FROM tasks ORDER BY ' . $field . ' ' . $sortType . ' LIMIT ' . $start . ', ' . $this->limit;

        return $this->db->query($sql, [] , '\App\Models\Task');

    }

    /**
     * @return int
     */

    public function getPageNums()
    {

        $pages = ($this->count / $this->limit);

        if (is_float($pages)) {

            return (int)ceil($pages);

        }

        return $pages;

    }

    /**
     * @return bool|int
     *
     */
    public function getNextPage()
    {

        if (($this->page + 1) > $this->getPageNums()){
            return false;
        }

        return $this->page + 1;

    }

}