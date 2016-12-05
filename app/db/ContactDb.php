<?php

namespace Db;

use Db\SqlLite;
use Model\Post;

class ContactDb
{
    private $db;

    public function __construct()
    {
        $this->db = SqlLite::getInstance();
    }

    public function saveContact($content)
    {
        $stmt = $this->db->prepare("UPDATE contact SET content=:content WHERE id = 1;");
        if ($stmt === false)
            throw new \Exception('Problem with creation statment in ContactDb');

        $stmt->bindValue(':content', $content, SQLITE3_TEXT);
        return $stmt->execute();

    }

    public function getContact()
    {
        $result = $this->db->query("SELECT content FROM contact WHERE id = 1;");
        $content = $result->fetchArray();

        if (!$content) {
            $this->saveContact('Short example...');
        }
        return $content['content'];
    }
} 