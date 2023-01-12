<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index(): void
    {
        View::render('home/index');
    }
}