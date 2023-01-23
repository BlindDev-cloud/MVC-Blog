<?php

declare(strict_types=1);

namespace App\Validators\Base;

use App\Models\User;

class UserBaseValidator extends BaseValidator
{
    protected array $errors = [
        'email' => [
            'type' => 'danger',
            'message' => 'Invalid email'
        ],
        'password' => [
            'type' => 'danger',
            'message' => 'Password must be at least 8 characters'
        ]
    ];

    protected array $rules = [
        'email' => '/^[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i',
        'password' => '/[a-zA-Z0-9.!#$%&\'*+\/\?^_`{|}~-]{8,}/'
    ];

    public function userExists(string $email): bool
    {
        return (bool)User::findBy('email', $email);
    }
}