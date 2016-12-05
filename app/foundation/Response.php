<?php
/**
 * Created by PhpStorm.
 * User: sosek108
 * Date: 20.11.16
 * Time: 14:01
 */

namespace Foundation;


class Response
{
    private $template;
    private $params;
    private $title;
    private $message;
    private $error;
    private $user;

    public function __construct($template, $params = [])
    {
        $this->template = $template;
        $this->params = $params;
        $request = Request::get();
        $this->user = $request->getUser();
        $this->message = $request->getMessage();
        $this->error = $request->getError();
    }

    public function render()
    {
        $template = $this->getTemplateFileName();
        $title = $this->title;

        if (!empty($this->message)) {
            $_SESSION['message'] = '';
        }
        if (!empty($this->error)) {
            $_SESSION['error'] = '';
        }

        foreach($this->params as $key => $value) {
            $$key = $value;
        }
        require_once __DIR__ . '/../view/layout.php';
    }

    public function getTemplateFileName()
    {
        if (empty($this->template))
            throw new \Exception('Template is not set. You should set template name before you render page.');
        if (!file_exists(__DIR__ . '/../view/' . $this->template . '.php'))
            throw new \Exception('Template file ' . $this->template . ' is not found.');

        return __DIR__ . '/../view/' . $this->template . '.php';
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function addParams($params)
    {
        $this->params = array_merge($this->params, $params);
    }

    public function addParam($param, $value)
    {
        $this->params[$param] = $value;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * Returns directory where index.php is stored (relative to apache)
     */
    public function getPrefix()
    {
        $index = $_SERVER['PHP_SELF'];
        preg_match('/^(?<prefix>.*)index\.php/', $index, $matches);

        return isset($matches['prefix']) ? $matches['prefix'] : '/';
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    public function startSession($user)
    {
        session_regenerate_id();
        $_SESSION['login'] = $user->getLogin();
        $_SESSION['pass'] = $user->getHashedPassword();
        $_SESSION['message'] = "Successfully logged in.";
    }

    public function deleteSession()
    {
        session_destroy();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

} 