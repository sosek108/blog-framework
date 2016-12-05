<?php

namespace Controller;

use Db\ContactDb;
use Db\PostDb;
use Foundation\Response;

class DefaultController extends AbstractController
{
    public function indexAction()
    {
        $postDb = new PostDb();
        $count = $postDb->countPosts();
        $perPage = $this->container['config']['config']['postsPerPage'];
        $page = $this->request->getParam('page') ? $this->request->getParam('page') : 1;
        $posts = $postDb->listPosts($page, $perPage);
        $maxPage = $postDb->maxPage($perPage);
        $params = [
            'count' => $count,
            'perPage' => $perPage,
            'posts' => $posts,
            'maxPage' => $maxPage,
            'page' => $page,
        ];
        return new Response('frontpage', $params, $this->flash);
    }

    public function contactAction()
    {
        $db = new ContactDb();
        $edit = $this->request->getParam('edit');
        $response = new Response('contactpage');

        if ($this->request->getMethod() == "POST") {
            $content = $this->request->getParam('content');
            if ($db->saveContact($content)) {
                $response->setMessage('Saved!');
                $edit = 0;
            } else {
                $response->setError('Error occured. Not Saved.');
            }
        }
        if ($edit)
            $this->needLogin();

        $content = $db->getContact();

        $response->addParam('content', $content);
        $response->addParam('edit', $edit);

        return $response;
    }
}
