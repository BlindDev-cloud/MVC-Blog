<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\View;

class DashboardController extends BaseController
{
    public function index(): void
    {
        View::render('admin/dashboard');
    }
}