<?php

namespace Controller;

use Db\SqlLite;
use Db\UserDb;
use Foundation\RedirectResponse;
use Foundation\Request;

abstract class AbstractController
{
    protected $container;
    protected $flash;
    protected $request;

    public function __construct($container)
    {
        $this->container = $container;
        $this->request = Request::get();
    }

    /**
     * @param $action
     * @return \Foundation\Response
     * @throws \Exception
     */
    public function process($action)
    {
        $method = $action . 'Action';

        if(!method_exists($this, $method)) {
            $class = get_class($this);
            throw new \Exception("Action $action does not exist in controller $class");
        }

        return $this->$method();
    }

    public function needLogin()
    {
        $user = $this->request->getUser();
        if (empty($user)) {
            $response = new RedirectResponse('login');
            $response->setMessage('Please login to continue.');
            $response->addParam('redirect', ltrim($this->container['path'], '/'));
            return $response;
        }
        return false;
    }
} 