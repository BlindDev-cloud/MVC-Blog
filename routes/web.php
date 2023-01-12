<?php

use Core\Router;

Router::add('', ['controller' => 'App\Controllers\HomeController', 'action' => 'index', 'method' => 'GET']);

Router::add('login', ['controller' => 'App\Controllers\AuthController', 'action' => 'login', 'method' => 'GET']);
Router::add('logout', ['controller' => 'App\Controllers\AuthController', 'action' => 'logout', 'method' => 'GET']);
Router::add('registration', ['controller' => 'App\Controllers\AuthController', 'action' => 'registration', 'method' => 'GET']);
Router::add('auth/verify', ['controller' => 'App\Controllers\AuthController', 'action' => 'verify', 'method' => 'POST']);

Router::add('user/store', ['controller' => 'App\Controllers\UserController', 'action' => 'store', 'method' => 'POST']);
