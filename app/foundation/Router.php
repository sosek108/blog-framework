<?php

namespace Foundation;


class Router
{
    protected $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param $path
     * @return array [controller, action, params]
     */
    public function resolveAction($path)
    {
        if (array_key_exists($path, $this->routes)) {
            $actionString = $this->routes[$path];
            $ctlrAction = explode(':', $actionString);

            if (count($ctlrAction) != 2)
                throw new \Exception('There is a problem with action: ' . $actionString);

            return [
                'controller' => $ctlrAction[0],
                'action' => $ctlrAction[1],
            ];

        } else {
            throw new \Exception('Route is not found.');
        }
    }
} 