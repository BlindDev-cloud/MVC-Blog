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
Router::add('admin/posts/store', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'store', 'method' => 'POST']);
Router::add('admin/posts/selectPostCategory', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'selectPostCategory', 'method' => 'GET']);
Router::add('admin/posts/by_category', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'byCategory', 'method' => 'GET']);
Router::add('admin/posts/show', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'show', 'method' => 'GET']);
Router::add('admin/posts/edit', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'edit', 'method' => 'GET']);
Router::add('admin/posts/update', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'update', 'method' => 'POST']);
Router::add('admin/posts/remove', ['controller' => 'App\Controllers\Admin\PostsController', 'action' => 'remove', 'method' => 'POST']);

Router::add('account/dashboard', ['controller' => 'App\Controllers\Account\DashboardController', 'action' => 'index', 'method' => 'GET']);

Router::add('account/posts', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'index', 'method' => 'GET']);
Router::add('account/posts/create', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'create', 'method' => 'GET']);
Router::add('account/posts/selectPostCategory', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'selectPostCategory', 'method' => 'GET']);
Router::add('account/posts/store', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'store', 'method' => 'POST']);
Router::add('account/posts/show', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'show', 'method' => 'GET']);
Router::add('account/posts/edit', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'edit', 'method' => 'GET']);
Router::add('account/posts/update', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'update', 'method' => 'POST']);
Router::add('account/posts/remove', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'remove', 'method' => 'POST']);
Router::add('account/posts/by_category', ['controller' => 'App\Controllers\Account\PostsController', 'action' => 'byCategory', 'method' => 'GET']);

Router::add('account/categories', ['controller' => 'App\Controllers\Account\CategoriesController', 'action' => 'index', 'method' => 'GET']);
