<?php

declare(strict_types=1);

namespace App\Validators;

use App\Validators\Base\UserBaseValidator;

class CreateUserValidator extends UserBaseValidator
{
    protected array $errors = [
        'email' => [
            'type' => 'danger',
            'message' => 'Invalid email'
        ],
        'password' => [
            'type' => 'danger',
            'message' => 'Password must be at least 8 characters'
        ],
        'name' => [
            'type' => 'warning',
            'message' => 'Name must be at least 2 characters'
        ],
        'surname' => [
            'type' => 'warning',
            'message' => 'Surname must be at least 2 characters'
        ]
    ];

    protected array $rules = [
        'name' => '/[A-Za-zА-Яа-я]{2,50}/',
        'surname' => '/[A-Za-zА-Яа-я]{2,50}/',
        'email' => '/^[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
        'password' => '/[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]{8,}/'
    ];
}