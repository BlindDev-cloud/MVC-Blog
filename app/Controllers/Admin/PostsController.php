<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Core\View;

class PostsController extends BaseController
{
    public function index(): void
    {
        $posts = Post::all()->get();
        View::render('admin/posts/index', compact('posts'));
    }

    public function create(): void
    {
        View::render('admin/posts/create');
    }
}