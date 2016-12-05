<?php

namespace Controller;


class ControllerFactory
{
    /**
     * @param $name
     * @param $container
     * @return AbstractController
     * @throws \Exception
     */
    public static function getController($name, $container)
    {
        $files = preg_grep('/^(.*)Controller\.php$/', scandir(__DIR__));
        $controllers = [];
        foreach ($files as $file) {
            preg_match('/^(?<name>.*)Controller\.php$/', $file, $matches);
            if ($matches['name'] == 'Abstract') continue;

            $controllers[$matches['name']] = self::getClassNameWithNamespace($matches['name']);
        }

        if (!array_key_exists($name, $controllers))
            throw new \Exception("Controller $name is not found.");

        return new $controllers[$name]($container);
    }

    private function getClassNameWithNamespace($name)
    {
        return __NAMESPACE__ . '\\' . $name . 'Controller';
    }
} 