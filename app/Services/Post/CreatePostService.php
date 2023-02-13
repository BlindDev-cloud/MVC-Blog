<?php

declare(strict_types=1);

namespace App\Services\Post;

use App\Helpers\SessionHelper;
use App\Models\Post;
use App\Validators\Post\CreatePostValidator;
use App\Services\FileUploadService;

class CreatePostService
{
    public static function call(array $fields): void
    {
        $validator = new CreatePostValidator();

        $validator->validate($fields);

        if (SessionHelper::hasAlerts() || !$validator->validateImage($_FILES['thumbnail'])) {
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        if (!$validator->authorExists((int)$fields['author_id'])) {
            SessionHelper::setAlert('author_id', 'danger', 'User does not exist');
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        if (!$validator->categoryExists((int)$fields['category_id'])) {
            SessionHelper::setAlert('category_id', 'danger', 'Category does not exist');
            SessionHelper::setFormData($fields);
            redirectBack();
        }

        $fields['thumbnail'] = FileUploadService::upload($_FILES['thumbnail']);

        if (!Post::create($fields)) {
            exit('Category has not been created');
        }
    }
}