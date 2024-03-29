<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Models\User;
use App\Validators\CreateUserValidator;
use Core\BaseException;
use Core\Controller;

class UserController extends Controller
{
    public function store(): void
    {
        $fields = filter_input_array(INPUT_POST, $_POST, true);
        $validator = new CreateUserValidator();

        $validator->validate($fields);

        if(SessionHelper::hasAlerts()){
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        if ($validator->userExists($fields['email'])) {
            SessionHelper::setAlert('email', 'warning', 'User already exists');
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        $fields['password'] = password_hash($fields['password'], PASSWORD_BCRYPT);

        if (!User::create($fields)) {
            throw new BaseException('Internal Server Error', 500);
        }

        redirect('login');
    }
}