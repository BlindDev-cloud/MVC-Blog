<?php

declare(strict_types=1);

namespace App\Validators\Base;

use App\Models\User;

class UserBaseValidator extends BaseValidator
{
    public function userAlreadyExists(string $email): bool|User
    {
        return User::findBy('email', $email);
    }
}