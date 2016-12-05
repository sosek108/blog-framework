<?php

namespace Db;

use Db\SqlLite;
use Model\Post;

class PostDb
{
    private $db;

    public function __construct()
    {
        $this->db = SqlLite::getInstance();
    }

    public function savePost(Post $post)
    {
        $stmt = $this->db->prepare("INSERT INTO post (title, text, author, created_at) VALUES(:title, :text, :author, :createdAt);");
        if ($stmt === false)
            throw new \Exception('Problem with creation statment in PostDb');

        $stmt->bindValue(':title', $post->getTitle(), SQLITE3_TEXT);
        $stmt->bindValue(':text', $post->getText(), SQLITE3_TEXT);
        $stmt->bindValue(':author', $post->getAuthor(), SQLITE3_TEXT);
        $stmt->bindValue(':createdAt', $post->getDate()->getTimestamp(), SQLITE3_INTEGER);
        return $stmt->execute();

    }

    public function getPost($id)
    {
        $stmt = $this->db->prepare("SELECT id, title, text, author, created_at FROM post WHERE id=:id");
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

        $result =  $stmt->execute()->fetchArray();
        if ($result) {
            $post = new Post();
            $post->setAuthor($result['author']);
            $post->setTitle($result['title']);
            $post->setText($result['text']);
            $date = new \DateTime();
            $date->setTimestamp($result['created_at']);
            $post->setDate($date);
            return $post;
        } else {
            return false;
        }
    }
    public function countPosts()
    {
        $result = $this->db->query("SELECT count(*) as count FROM post");
        return $result->fetchArray()['count'];
    }

    public function listPosts($page = 1, $perPage = 0)
    {

        if ($perPage > 0) {
            if ($page > $this->maxPage($perPage))
                $page = $this->maxPage($perPage);
            $offset = ($page-1)*$perPage;
            $limit = $perPage;

            $sql = "SELECT id, title, text, author, created_at FROM post LIMIT $offset, $limit";
        } else {
            $sql = "SELECT id, title, text, author, created_at FROM post";
        }

        $result = $this->db->query($sql);
        $posts = [];
        while($row = $result->fetchArray()) {
            $post = new Post();
            $post->setTitle($row['title']);
            $post->setText($row['text']);
            $post->setAuthor($row['author']);
            $date = new \DateTime();
            $date->setTimestamp($row['created_at']);
            $post->setDate($date);
            $posts[$row['id']] = $post;
        }

        return $posts;
    }

    public function maxPage($perPage)
    {
        if ($perPage == 0 )
            return 1;

        $count = $this->countPosts();

        return ceil($count/$perPage);
    }
} 