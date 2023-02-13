<?php

declare(strict_types=1);

namespace App\Controllers\Account;

use Core\View;
use App\Models\Category;

class DashboardController extends BaseController
{
    public function index(): void
    {
        View::render('account/dashboard');
    }
}