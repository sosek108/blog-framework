<?php
/**
 * Created by PhpStorm.
 * User: sosek108
 * Date: 20.11.16
 * Time: 14:01
 */

namespace Foundation;


class RedirectResponse extends Response
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function render()
    {
        $error = $this->getError();
        $message = $this->getMessage();

        session_start();
        if (!empty($message))
            $_SESSION['message'] = $message;
        if (!empty($error))
            $_SESSION['error'] = $error;

        if (empty($this->getParams()))
            header('Location: ' . $this->path);
        else
            header('Location: ' . $this->path . '?' . http_build_query($this->getParams()));
        exit();
    }
} 