<?php

namespace Db;


class SqlLite extends \SQLite3
{
    public static $instance;

    public function __construct($db)
    {
        $dbfile = __DIR__. '/../../db/' . $db;
        return parent::__construct($dbfile);

    }
    public static function getInstance($db = '')
    {
        if (self::$instance === null) {
            self::$instance = new SqlLite($db);
        }
        return self::$instance;
    }
} 