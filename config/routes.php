<?php

/*
 * List of routes with pattern
 * ROUTE => Controller:Action
 */
$routes = [
    '/' => 'Default:index',
    '/post' => 'Post:post',
    '/list' => 'Post:list',
    '/add' => 'Post:add',
    '/logout' => 'User:logout',
    '/login' => 'User:login',
    '/contact' => 'Default:contact',
];