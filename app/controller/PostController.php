<?php
/**
 * Created by PhpStorm.
 * User: sosek108
 * Date: 20.11.16
 * Time: 18:34
 */

namespace Controller;


use Foundation\RedirectResponse;
use Foundation\Response;
use Model\Post;
use Db\PostDb;

class PostController extends AbstractController
{
    public function postAction()
    {
        $id = $this->request->getParam('id');
        if (empty($id))
            throw new Exception("Id of post cannot be null");

        $db = new PostDb();

        $post = $db->getPost($id);

        if(!$post) {
            $response = new RedirectResponse('/');
            $response->setError('Post with given id is not found.');
            return $response;
        }

        $params = [
            'post' => $post,
        ];
        return new Response('showpostpage', $params);
    }

    public function addAction()
    {
        if ($r = $this->needLogin())
            return $r;

        $response = new Response('addpostpage');
        if ($this->request->getMethod() == "POST") {
            $post = new Post();
            $post->setAuthor($this->request->getParam('author'));
            $post->setText($this->request->getParam('text'));
            $post->setTitle($this->request->getParam('title'));

            if (!$post->validate()) {
                $response->setError('Some errors occured in input');
            } else {
                $postDb = new PostDb();
                if($postDb->savePost($post)) {
                    $response = new RedirectResponse('/');
                    $response->setMessage('Congratulations! You\'ve added another post!');
                } else {
                    $response->setError('Some errors occured  during post creation.');
                }


            }

        }
        return $response;
    }

} 