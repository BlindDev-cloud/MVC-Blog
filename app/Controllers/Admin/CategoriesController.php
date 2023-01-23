<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Helpers\SessionHelper;
use App\Models\Category;
use App\Services\FileUploadService;
use App\Validators\CreateCategoryValidator;
use App\Validators\UpdateCategoryValidator;
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
        $category = (Category::find($id)) ? Category::find($id) : null;
        View::render('admin/categories/show', compact('category'));
    }

    public function edit(int $id): void
    {
        $category = (Category::find($id)) ? Category::find($id) : null;
        View::render('admin/categories/edit', compact('category'));
    }

    public function update(): void
    {
        $fields = filter_input_array(INPUT_POST, $_POST, true);
        $validator = new UpdateCategoryValidator();

        $validator->validate($fields);

        if (SessionHelper::hasAlerts()) {
            redirectBack();
        }

        $id = (int)$fields['id'];

        if (!$validator->categoryExists($id)) {
            SessionHelper::setAlert('id', 'danger', 'Category does not exist');
            redirectBack();
        }

        if (!empty($_FILES['image']['name'])) {

            if (!$validator->validateImage($_FILES['image'])) {
                redirectBack();
            }

            $oldImage = Category::find($id)->image;
            $oldImagePath = STORAGE_DIR . '/' . $oldImage;

            FileUploadService::remove($oldImagePath);

            $fields['image'] = FileUploadService::upload($_FILES['image']);
        }

        Category::update($fields);

        redirect('admin/categories');
    }

    public function create(): void
    {
        View::render('admin/categories/create');
    }

    public function store(): void
    {
        $fields = filter_input_array(INPUT_POST, $_POST, true);
        $validator = new CreateCategoryValidator();

        $validator->validate($fields);

        if (SessionHelper::hasAlerts() || !$validator->validateImage($_FILES['image'])) {
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        $fields['image'] = FileUploadService::upload($_FILES['image']);

        if (!Category::create($fields)) {
            exit('Category has not been created');
        }

        redirect('admin/categories');
    }

    public function remove(): void
    {
        $fields = filter_input_array(INPUT_POST, $_POST, true);
        $validator = new UpdateCategoryValidator();

        $validator->validate($fields);

        if(SessionHelper::hasAlerts()){
            redirectBack();
        }

        $id = (int)$fields['id'];

        if(!$validator->categoryExists($id)){
            SessionHelper::setAlert('id', 'danger', 'Category does not exist');
            redirectBack();
        }

        $oldImage = Category::find($id)->image;
        $oldImagePath = STORAGE_DIR . '/' . $oldImage;

        FileUploadService::remove($oldImagePath);

        Category::delete($id);

        redirectBack();
    }
}