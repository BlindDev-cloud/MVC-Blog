<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Services\AuthSecrvice;
use Core\Controller;
use Core\View;

class AuthController extends Controller
{
    public function login(): void
    {
        View::render('auth/login');
    }

    public function logout(): void
    {
        SessionHelper::destroy();
        redirect();
    }

    public function registration():void
    {
        View::render('auth/registration');
    }

    public function verify(): void
    {
        $fields = filter_input_array(INPUT_POST, $_POST, true);

        AuthSecrvice::call($fields);
        
        redirect();
    }

    public function before(string $action): bool
    {
        if(in_array($action, ['login', 'registration']) && SessionHelper::isLoggedIn()){
            return false;
        }

        return parent::before($action);
    }
}