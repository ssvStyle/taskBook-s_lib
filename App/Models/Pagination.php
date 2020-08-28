<?php

namespace App\Models;

use App\Models\Db;

class Pagination
{
    protected $limit;
    protected $count;
    protected $db;
    protected $page;

    public function __construct(Db $db, $table, $limit)
    {
        $this->db = new $db;
        $sql = 'SELECT COUNT(*) FROM ' . $table;
        $this->count = (int)$db->query($sql, [])[0]['COUNT(*)'];
        $this->limit = $limit;


    }

    /**
     * @param int $page
     *
     * @return object;
     */
    public function setPage($page)
    {

        $this->page = $page;
        return $this;

    }

    /**
     * @param int $page
     *
     * @return array|object
     */
    public function getFromToByPage($page)
    {
        if ($page > $this->getPageNums()) {
            $page = 1;
        }

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

        return ['from' => $start, 'to' => $this->limit];

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

    /**
     * @return bool|int
     *
     */
    public function getPrevPage()
    {

        if (($this->page - 1) <= 0){
            return false;
        }

        return $this->page - 1;

    }

}