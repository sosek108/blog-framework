<?php

namespace Foundation;

use Db\UserDb;

class Request {
    private static $instance;
    private $uri;
    private $path;
    private $params;
    private $message;
    private $error;
    private $method;
    private $user;

    public function __construct()
    {
        $this->setUri($_SERVER['REQUEST_URI']);
        $path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        $this->setPath($path);

        $this->message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
        $this->error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
        $this->setParams($_REQUEST);

        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->validateSession();
    }
    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = new Request();
        }

        return self::$instance;
    }


    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParam($name)
    {
        if (array_key_exists($name, $this->params)) {
            return $this->params[$name];
        } else {
            return null;
        }
    }
    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getUriWithoutParams()
    {
        return $this->uriWithoutParams;
    }

    public function setUriWithoutParams($uriWithoutParams)
    {
        $this->uriWithoutParams = $uriWithoutParams;
    }

    public function getArgv()
    {
        return $this->argv;
    }

    public function setArgv($argv)
    {
        $this->argv = $argv;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getFlash()
    {
        return $this->flash;
    }

    /**
     * @param mixed $flash
     */
    public function setFlash($flash)
    {
        $this->flash = $flash;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    protected function validateSession()
    {
        session_start();
        if (isset($_SESSION['login']) and isset($_SESSION['pass'])) {
            $userDb = new UserDb();
            $this->user = $userDb->getUser($_SESSION['login'], $_SESSION['pass']);

            if ($this->user)
                return $this->user;
        }

        if (isset($_SESSION['message']))
            $this->message = $_SESSION['message'];
        if (isset($_SESSION['error']))
            $this->error = $_SESSION['error'];
        return null;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

} 