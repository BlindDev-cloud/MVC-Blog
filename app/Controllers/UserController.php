<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Models\User;
use App\Validators\CreateUserValidator;
use Core\Controller;
use Core\View;

class UserController extends Controller
{
    public function store()
    {
        $fields = filter_input_array(INPUT_POST, $_POST, true);
        $validator = new CreateUserValidator();

        $validator->validate($fields);

        if ($validator->userAlreadyExists($fields['email'])) {
            SessionHelper::setAlert('email', 'warning', 'User already exists');
        }

        if (SessionHelper::hasAlerts()) {
            View::render('auth/registration', ['data' => $fields]);
            exit();
        }

        $fields['password'] = password_hash($fields['password'], PASSWORD_BCRYPT);

        if (!User::create($fields)) {
            exit('User has not been created');
        }

        redirect('login');
    }
}