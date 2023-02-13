<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Services\Category\CreateCategoryService;
use App\Services\Category\RemoveCategoryService;
use App\Services\Category\UpdateCategoryService;
use Core\View;

class CategoriesController extends BaseController
{
    public function index(): void
    {
        $categories = Category::all()->get();
        View::render('admin/categories/index', compact('categories'));
    }

    public function show(int $id): void
    {
        $category = Category::find($id);
        View::render('admin/categories/show', compact('category'));
    }

    public function edit(int $id): void
    {
        $category = Category::find($id);
        View::render('admin/categories/edit', compact('category'));
    }

    public function update(): void
    {
        UpdateCategoryService::call($this->fields);

        redirect('admin/categories');
    }

    public function create(): void
    {
        View::render('admin/categories/create');
    }

    public function store(): void
    {
        CreateCategoryService::call($this->fields);

        redirect('admin/categories');
    }

    public function remove(): void
    {
        RemoveCategoryService::call($this->fields);

        redirectBack();
    }
}