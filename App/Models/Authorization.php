<?php

namespace App\Models;

use \App\Models\Db as db;

class Authorization
{
    protected $db;
    protected $login;
    protected $pass;
    protected $hash;
    protected $user;

    /**
     * AuthServise constructor.
     * @param \App\Models\Db $db
     *
     */
    public function __construct(Db $db)
    {
            $this->db = $db;

    }

    /**
     * @param $hash
     * 
     * @return bool
     */
    public function userVerify()
    {
        $hash = $_SESSION['UserHash'] ?? false;

        if ($hash) {

            $sql = 'SELECT * FROM users WHERE sessionHash=:hash';

            if ($this->db->query($sql, [':hash' => $hash])) {

                return true;

            }
        }

        return false;
        
    }

    /**
     * @param $login
     * 
     * @return bool
     */
    public function loginExist($login)
    {

        $sql = 'SELECT * FROM users WHERE login=:login';

        if($this->db->query($sql, [':login' => $login])) {

            return true;

        }
        return false;
        
    }

    /**
     * @param $login
     * @param $pass
     *
     * @return bool
     */

    public function loginAndPassValidation($login, $pass)
    {
        if ($this->loginExist($login)) {

            $sql = 'SELECT users.id, login, pass, sessionHash, usersStatus.status FROM users
                    LEFT JOIN usersStatus ON users.status_id=usersStatus.id
                    WHERE login=:login';
            $user = $this->db->queryRetObj($sql, [':login' => $login], '\App\Models\User')[0] ?? false;

            if ($user) {
                if ( password_verify($pass, $user->getPass()) ) {
                    $this->user = $user;
                    return true;
                }
            }

        }

        return false;

    }

    /**
     * @return bool
     */
    public function setAuth($cookie = false)
    {
        $hash = sha1(microtime() . rand(0, 1000000000));

        $sql = 'UPDATE users SET sessionHash=:hash WHERE id=:id';

        if ($this->db->execute($sql, [':hash'=> $hash, ':id' => $this->user->getId()])) {

            $_SESSION['UserHash'] = $hash;

            if ($cookie) {

                setcookie("UserHash", $hash, time() + 3600, '/');
            }

            return true;
        }
    }

    /**
     * @return bool
     */
    public function exitAuth()
    {
        $hashSession = $_SESSION['UserHash'] ?? null;

        $sql = 'UPDATE users SET sessionHash=:hash WHERE sessionHash=:hashSession';

        if ($this->db->execute($sql, [':hash'=> '', ':hashSession' => $hashSession])) {

            unset($_SESSION['UserHash']);
            setcookie("UserHash", "", time() - 3600*60, '/');
            session_regenerate_id(true);
            return true;

        }
    }



}