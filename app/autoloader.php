<?php

spl_autoload_register(function($className) {
    $structure = explode('\\', $className);

    $class = $structure[count($structure)-1];
    $dirs = array_slice($structure, 0, count($structure)-1);

    $filepath = '';
    //Namespace should be camelcased and folder will be lowercase
    foreach ($dirs as $dir) {
        $filepath .= strtolower($dir) . '/';
    }
    $file = $filepath . $class . '.php';

    include $file;
});