<?php

use Core\Router;

Router::add('', ['controller' => 'App\Controllers\HomeController', 'action' => 'index', 'method' => 'GET']);

Router::add('login', ['controller' => 'App\Controllers\AuthController', 'action' => 'login', 'method' => 'GET']);
Router::add('logout', ['controller' => 'App\Controllers\AuthController', 'action' => 'logout', 'method' => 'GET']);
Router::add('registration', ['controller' => 'App\Controllers\AuthController', 'action' => 'registration', 'method' => 'GET']);
Router::add('auth/verify', ['controller' => 'App\Controllers\AuthController', 'action' => 'verify', 'method' => 'POST']);

Router::add('user/store', ['controller' => 'App\Controllers\UserController', 'action' => 'store', 'method' => 'POST']);

Router::add('admin/dashboard', ['controller' => 'App\Controllers\Admin\DashboardController', 'action' => 'index', 'method' => 'GET']);

Router::add('admin/categories', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'index', 'method' => 'GET']);
Router::add('admin/categories/create', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'create', 'method' => 'GET']);
Router::add('admin/categories/store', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'store', 'method' => 'POST']);
Router::add('admin/categories/show', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'show', 'method' => 'GET']);
Router::add('admin/categories/edit', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'edit', 'method' => 'GET']);
Router::add('admin/categories/update', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'update', 'method' => 'POST']);
Router::add('admin/categories/remove', ['controller' => 'App\Controllers\Admin\CategoriesController', 'action' => 'remove', 'method' => 'POST']);

Router::add('admin/posts', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'index', 'method' => 'GET']);
Router::add('admin/posts/create', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'create', 'method' => 'GET']);


