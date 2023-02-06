<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\Helpers\SessionHelper;
use App\Models\Category;
use App\Services\FileUploadService;
use App\Validators\Category\UpdateCategoryValidator;

class RemoveCategoryService
{
    public static function call(array $fields): void
    {
        $validator = new UpdateCategoryValidator();

        $validator->validate($fields);

        if(SessionHelper::hasAlerts()){
            redirectBack();
        }

        $id = (int)$fields['id'];

        if(!$validator->categoryExists($id)){
            redirectBack();
        }

        $oldImage = Category::find($id)->image;
        $oldImagePath = STORAGE_DIR . '/' . $oldImage;

        FileUploadService::remove($oldImagePath);

        Category::delete($id);
    }
}