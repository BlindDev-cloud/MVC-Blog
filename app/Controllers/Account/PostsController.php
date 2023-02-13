<?php

declare(strict_types=1);

namespace App\Controllers\Account;

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
        $id = SessionHelper::id();
        $posts = Post::innerJoin('users', 'author_id')
            ->where('author_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
        View::render('account/posts/index', compact('posts'));
    }

    public function create(): void
    {
        $categories = Category::all()->get();
        View::render('account/posts/create', compact('categories'));
    }

    public function selectPostCategory(int $id, string $title): void
    {
        $_SESSION['postCategory'] = [
            'id' => $id,
            'title' => $title
        ];
        redirectBack();
    }

    public function store(): void
    {
        CreatePostService::call($this->fields);

        redirect('account/posts');
    }

    public function show(int $id): void
    {
        $post = Post::find($id);

        if(!$post){
            redirect('account/posts');
        }

        $postCategory = Category::find($post->category_id)->title;
        View::render('account/posts/show', compact('post', 'postCategory'));
    }

    public function edit(int $id): void
    {
        $post = Post::find($id);
        View::render('account/posts/edit', compact('post', 'categories'));
    }

    public function update(): void
    {
        UpdatePostService::call($this->fields);

        redirect('account/posts');
    }

    public function remove(): void
    {
        RemovePostService::call($this->fields);

        redirect('account/posts');
    }

    public function byCategory(int $id): void
    {
        $posts = Post::innerJoin('categories', 'category_id', ['*'])
            ->where('category_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        View::render('account/posts/index', compact('posts'));
    }
}