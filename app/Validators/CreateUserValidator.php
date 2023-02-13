<?php

declare(strict_types=1);

namespace App\Validators;

use App\Validators\Base\UserBaseValidator;

class CreateUserValidator extends UserBaseValidator
{
    public function __construct()
    {
        $this->addErrors([
            'name' => [
                'type' => 'warning',
                'message' => 'Name must be at least 2 characters'
            ],
            'surname' => [
                'type' => 'warning',
                'message' => 'Surname must be at least 2 characters'
            ]
        ]);

        $this->addRules([
            'name' => '/[A-Za-zА-Яа-я]{2,50}/',
            'surname' => '/[A-Za-zА-Яа-я]{2,50}/',
        ]);
    }
}