<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\Helpers\SessionHelper;
use App\Models\Category;
use App\Services\FileUploadService;
use App\Validators\Category\UpdateCategoryValidator;

class UpdateCategoryService
{
    public static function call(array $fields): void
    {
        $validator = new UpdateCategoryValidator();

        $validator->validate($fields);

        if (SessionHelper::hasAlerts()) {
            redirectBack();
        }

        $id = (int)$fields['id'];

        if (!$validator->categoryExists($id)) {
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
    }
}