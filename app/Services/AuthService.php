<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\SessionHelper;
use App\Models\User;
use App\Validators\AuthValidator;

class AuthService
{
    public static function call(array $fields): void
    {
        $validator = new AuthValidator();

        $validator->validate($fields);

        if(SessionHelper::hasAlerts()){
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        if(!$validator->userExists($fields['email'])){
            SessionHelper::setAlert('email', 'danger', 'Incorrect email or password');
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        $user = User::findBy('email', $fields['email']);

        if(!$validator->verifyPassword($fields['password'], $user->password)){
            SessionHelper::setAlert('password', 'danger', 'Incorrect email or password');
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        SessionHelper::setUserData(
            $user->id,
            ['is_admin' => $user->is_admin]
        );
    }
}