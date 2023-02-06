<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\Helpers\SessionHelper;
use App\Models\Category;
use App\Services\FileUploadService;
use App\Validators\Category\CreateCategoryValidator;

class CreateCategoryService
{
    public static function call(array $fields): void
    {
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
    }
}