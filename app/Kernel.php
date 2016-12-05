<?php

use Foundation\Router;
use Foundation\Request;
use Controller\ControllerFactory;
use Db\SqlLite;

class Kernel
{
    protected $router;
    protected $config = [];

    public function __construct()
    {
        $this->loadConfiguration();

        if (isset($this->config['routes']))
            $this->router = new Router($this->config['routes']);
        else
            throw new Exception("Error with loading routes configuration");
    }

    public function handle()
    {
        $db = SqlLite::getInstance($this->config['config']['db']);
        $request = Request::get();
        $action = $this->router->resolveAction($request->getPath());

        if (!isset($this->config['config']['db']))
            throw new Exception('Database name is not set.');


        $container = [
            'config' => $this->config,
            'requestParams' => $request->getParams(),
            'path' => $request->getPath(),
        ];

        $controller = ControllerFactory::getController($action['controller'], $container);

        $response = $controller->process($action['action']);
        if (get_class($response) instanceof Foundation\Response)
            throw new Exception("Method action should return Response object.");

        $response->render();
        $db->close();
    }

    private function loadConfiguration()
    {
        $configDir = __DIR__ . '/../config';
        if ($files = scandir($configDir)) {
            foreach ($files as $file) {
                if ($file == '.' or $file == '..') continue;

                require_once $configDir . '/' . $file;
                $name = explode('.', $file)[0];
                $this->config[$name] = $$name;
            }
        } else {
            throw new Exception('There is a problem with config directory.');
        }
    }
} 