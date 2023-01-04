<?php

use Core\Router;

Router::add('', ['controller' => 'App\Controllers\HomeController', 'action' => 'index', 'method' => 'GET']);

