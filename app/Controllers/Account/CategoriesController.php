<?php

declare(strict_types=1);

namespace App\Controllers\Account;

use App\Models\Category;
use Core\View;

class CategoriesController extends BaseController
{
    public function index(): void
    {
        $categories = Category::all()->get();
        View::render('account/categories/index', compact('categories'));
    }
}