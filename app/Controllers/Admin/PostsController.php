<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\SessionHelper;
use App\Models\Category;
use App\Models\Post;
use App\Services\Post\CreatePostService;
use App\Services\Post\RemovePostService;
use App\Services\Post\UpdatePostService;
use Core\View;

class PostsController extends BaseController
{
    public function index(): void
    {
        $posts = Post::all()
            ->orderBy('created_at', 'DESC')
            ->get();
        View::render('admin/posts/index', compact('posts'));
    }

    public function create(): void
    {
        $categories = Category::all()->get();
        View::render('admin/posts/create', compact('categories'));
    }

    public function selectPostCategory(int $id, string $title): void
    {
        $_SESSION['postCategory'] = [
            'id' => $id,
            'title' => $title
        ];
        redirectBack();
    }

    public function byCategory(int $id, string $title): void
    {
        $_SESSION['category'] = [
            'title' => $title
        ];

        $posts = Post::innerJoin('categories', 'category_id', ['*'])
            ->where('category_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        View::render('admin/posts/index', compact('posts'));
    }

    public function store(): void
    {
        CreatePostService::call($this->fields);

        redirect('admin/posts');
    }

    public function show(int $id): void
    {
        $post = (Post::find($id)) ? Post::find($id) : null;
        View::render('admin/posts/show', compact('post'));
    }

    public function edit(int $id): void
    {
        $post = Post::find($id);
        View::render('admin/posts/edit', compact('post'));
    }

    public function update(): void
    {
        UpdatePostService::call($this->fields);

        redirect('admin/posts');
    }

    public function remove(): void
    {
        RemovePostService::call($this->fields);

        redirectBack();
    }
}