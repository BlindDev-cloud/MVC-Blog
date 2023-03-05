<?php

declare(strict_types=1);

namespace App\Validators\Category;

use App\Helpers\SessionHelper;
use App\Validators\ImageValidator;

class CreateCategoryValidator extends ImageValidator
{
    protected array $errors = [
        'title' => [
            'type' => 'warning',
            'message' => 'Title must be at least 2 characters'
        ],
        'description' => [
            'type' => 'warning',
            'message' => 'Description must be at least 5 characters'
        ]
    ];
    protected array $rules = [
        'title' => '/[\w\s\t\r\n^\p{L}._\-\?,\!]{2,100}/',
        'description' => '/[\w\s\t\r\n^\p{L}._\-\?,\!]{5,}/'
    ];
}