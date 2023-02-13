<?php

declare(strict_types=1);

namespace App\Validators;

use App\Validators\Base\UserBaseValidator;

class AuthValidator extends UserBaseValidator
{
    public function verifyPassword(string $userPassword, string $formPassword): bool
    {
        if(!password_verify($userPassword, $formPassword)){
            return false;
        }

        return true;
    }
}