<?php

namespace Db;

use Db\SqlLite;
use Model\User;

class UserDb
{
    private $db;

    public function __construct()
    {
        $this->db = SqlLite::getInstance();
    }

    public function getUser($login, $pass)
    {
        $stmt= $this->db->prepare("SELECT login, fullname, email, password FROM user WHERE login=:login");
        $stmt->bindValue(':login', $login, SQLITE3_TEXT);
        $ret = $stmt->execute()->fetchArray();

        if (!$ret)
            return null;

        if (!password_verify($pass, $ret['password']) and $pass != $ret['password'])
            return null;

        $user = new User();
        $user->setEmail($ret['email']);
        $user->setLogin($login);
        $user->setFullName($ret['fullname']);
        $user->setHashedPassword($ret['password']);
        return $user;
    }

    private function hash($string)
    {
        return password_hash($string, PASSWORD_DEFAULT);
    }

} 