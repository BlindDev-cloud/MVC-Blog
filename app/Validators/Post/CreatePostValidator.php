<?php

declare(strict_types=1);

namespace App\Validators\Post;

use App\Helpers\SessionHelper;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Validators\ImageValidator;

class CreatePostValidator extends ImageValidator
{
    protected array $errors = [
        'author_id' => [
            'type' => 'danger',
            'message' => 'Invalid author id'
        ],
        'category_id' => [
            'type' => 'danger',
            'message' => 'Invalid category'
        ],
        'title' => [
            'type' => 'warning',
            'message' => 'Title must be at least 2 characters'
        ],
        'content' => [
            'type' => 'warning',
            'message' => 'Content must be at least 5 characters'
        ]
    ];

    protected array $rules = [
        'author_id' => '/^\d{1,}$/',
        'category_id' => '/^\d{1,}$/',
        'title' => '/[\w\s\t\r\n]{2,100}/',
        'content' => '/[\w\s\t\r\n\.?!]{5,}/'
    ];

    public function authorExists(int $id): bool
    {
        return (bool)User::find($id);
    }

    public function categoryExists(int $id): bool
    {
        return (bool)Category::find($id);
    }

    public function postExists(int $id): bool
    {
        return (bool)Post::find($id);
    }
}